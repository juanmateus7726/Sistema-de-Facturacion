<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\VentasModel;
use App\Models\DetalleVentasModel;

class Reportes extends BaseController
{
    public function index()
    {
        return view('reportes/index');
    }


public function ventas()
{
    $ventasModel = new VentasModel();
    $clientesModel = new ClientesModel();

    
    // Obtener filtros (vacíos por defecto)
    $fechaInicio = $this->request->getGet('fecha_inicio');
    $fechaFin = $this->request->getGet('fecha_fin');
    $idCliente = $this->request->getGet('id_cliente');
    $metodoPago = $this->request->getGet('metodo_pago');
    
    // Query base
    $query = $ventasModel
        ->select('ventas.*, 
                  clientes.nombre as cliente_nombre, 
                  usuarios.nombre as cajero_nombre')
        ->join('clientes', 'clientes.id_cliente = ventas.id_cliente', 'left')
        ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario', 'left')
        ->where('ventas.estado', 1);
    
    // Aplicar filtros solo si están presentes
    if ($fechaInicio) {
        $query->where('DATE(ventas.fecha_hora) >=', $fechaInicio);
    }
    
    if ($fechaFin) {
        $query->where('DATE(ventas.fecha_hora) <=', $fechaFin);
    }
    
    if ($idCliente) {
        $query->where('ventas.id_cliente', $idCliente);
    }
    
    if ($metodoPago) {
        $query->where('ventas.metodo_pago', $metodoPago);
    }
    
    $ventas = $query->orderBy('ventas.fecha_hora', 'DESC')->findAll();
    
    // Calcular estadísticas
$totalVentas = count($ventas);
$montoTotal = 0;
$totalEfectivo = 0;
$totalTarjeta = 0;
$totalTransferencia = 0;
$totalMixto = 0;

foreach ($ventas as $venta) {
    $montoTotal += $venta['total'];
    
    // Convertir número a texto si es necesario
    $metodo = $venta['metodo_pago'];
    
    // Si es número, convertir a texto
    if (is_numeric($metodo)) {
        $metodosMap = [
            0 => 'efectivo',
            1 => 'tarjeta',
            2 => 'transferencia',
            3 => 'mixto'
        ];
        $metodo = $metodosMap[$metodo] ?? 'efectivo';
    }
    
    switch ($metodo) {
        case 'efectivo':
            $totalEfectivo += $venta['total'];
            break;
        case 'tarjeta':
            $totalTarjeta += $venta['total'];
            break;
        case 'transferencia':
            $totalTransferencia += $venta['total'];
            break;
        case 'mixto':
            $totalMixto += $venta['total'];
            break;
    }
}
    
    // Cargar clientes para el filtro
    $clientes = $clientesModel->findAll();
    
    $data = [
        'ventas' => $ventas,
        'clientes' => $clientes,
        'filtros' => [
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'id_cliente' => $idCliente,
            'metodo_pago' => $metodoPago
        ],
        'estadisticas' => [
            'total_ventas' => $totalVentas,
            'monto_total' => $montoTotal,
            'total_efectivo' => $totalEfectivo,
            'total_tarjeta' => $totalTarjeta,
            'total_transferencia' => $totalTransferencia,
            'total_mixto' => $totalMixto
        ]
    ];
    
    return view('reportes/ventas', $data);
}


public function clientes()
{
    $ventasModel = new VentasModel();
    
    // Obtener período (vacío por defecto)
    $fechaInicio = $this->request->getGet('fecha_inicio');
    $fechaFin = $this->request->getGet('fecha_fin');
    
    // Query base
    $query = $ventasModel
        ->select('clientes.nombre, clientes.documento, 
                  COUNT(ventas.id_venta) as total_compras, 
                  SUM(ventas.total) as monto_total')
        ->join('clientes', 'clientes.id_cliente = ventas.id_cliente')
        ->where('ventas.estado', 1)
        ->groupBy('ventas.id_cliente')
        ->orderBy('monto_total', 'DESC')
        ->limit(20);
    
    // Aplicar filtros solo si están presentes
    if ($fechaInicio) {
        $query->where('DATE(ventas.fecha_hora) >=', $fechaInicio);
    }
    
    if ($fechaFin) {
        $query->where('DATE(ventas.fecha_hora) <=', $fechaFin);
    }
    
    $topClientes = $query->findAll();
    
    $data = [
        'clientes' => $topClientes,
        'filtros' => [
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]
    ];
    
    return view('reportes/clientes', $data);
}


public function inventario()
{
    $productosModel = new ProductosModel();
    $detalleVentasModel = new DetalleVentasModel();
    $ventasModel = new VentasModel();
    
    // Obtener filtros (VACÍOS por defecto)
    $mes = $this->request->getGet('mes');
    $tipo = $this->request->getGet('tipo') ?: 'mas_vendidos';
    
    // Solo calcular fechas SI hay filtro de mes
    $fechaInicio = null;
    $fechaFin = null;
    
    if ($mes) {
        $fechaInicio = $mes . '-01';
        $fechaFin = date('Y-m-t', strtotime($fechaInicio));
    }
    
    // Query para productos más/menos vendidos
    $query = $detalleVentasModel
        ->select('productos.id_producto, productos.codigo, productos.nombre, 
                  categorias.nombre as categoria_nombre,
                  SUM(detalle_ventas.cantidad) as total_vendido,
                  COUNT(DISTINCT detalle_ventas.id_venta) as num_ventas,
                  SUM(detalle_ventas.subtotal_linea) as ingresos_generados')
        ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
        ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
        ->join('ventas', 'ventas.id_venta = detalle_ventas.id_venta')
        ->where('ventas.estado', 1);
    
    // Aplicar filtro de fecha SOLO si existe
    if ($fechaInicio && $fechaFin) {
        $query->where('DATE(ventas.fecha_hora) >=', $fechaInicio)
              ->where('DATE(ventas.fecha_hora) <=', $fechaFin);
    }
    
    $query->groupBy('productos.id_producto');
    
    if ($tipo == 'mas_vendidos') {
        $query->orderBy('total_vendido', 'DESC')->limit(20);
    } else {
        $query->orderBy('total_vendido', 'ASC')->limit(20);
    }
    
    $productosVendidos = $query->findAll();
    
    // Productos SIN ventas
    $queryIdsConVentas = $detalleVentasModel
        ->select('detalle_ventas.id_producto')
        ->join('ventas', 'ventas.id_venta = detalle_ventas.id_venta')
        ->where('ventas.estado', 1);
    
    // Aplicar filtro de fecha SOLO si existe
    if ($fechaInicio && $fechaFin) {
        $queryIdsConVentas->where('DATE(ventas.fecha_hora) >=', $fechaInicio)
                          ->where('DATE(ventas.fecha_hora) <=', $fechaFin);
    }
    
    $idsConVentas = $queryIdsConVentas->groupBy('detalle_ventas.id_producto')
                                       ->findColumn('id_producto');
    
    $productosSinVentas = [];
    
    if (!empty($idsConVentas)) {
        $productosSinVentas = $productosModel
            ->select('productos.*, categorias.nombre as categoria_nombre')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->where('productos.estado', 1)
            ->whereNotIn('productos.id_producto', $idsConVentas)
            ->findAll();
    } else {
        $productosSinVentas = $productosModel
            ->select('productos.*, categorias.nombre as categoria_nombre')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->where('productos.estado', 1)
            ->findAll();
    }
    
    // Estadísticas
    $queryVentas = $ventasModel->where('estado', 1);
    
    // Aplicar filtro de fecha SOLO si existe
    if ($fechaInicio && $fechaFin) {
        $queryVentas->where('DATE(fecha_hora) >=', $fechaInicio)
                    ->where('DATE(fecha_hora) <=', $fechaFin);
    }
    
    $totalVentasPeriodo = $queryVentas->countAllResults();
    
    $data = [
        'productos' => $productosVendidos,
        'productos_sin_ventas' => $productosSinVentas,
        'filtros' => [
            'mes' => $mes,
            'tipo' => $tipo
        ],
        'stats' => [
            'total_ventas_periodo' => $totalVentasPeriodo,
            'productos_sin_movimiento' => count($productosSinVentas)
        ],
        'tiene_filtro_fecha' => !empty($mes)
    ];
    
    return view('reportes/inventario', $data);
}
}