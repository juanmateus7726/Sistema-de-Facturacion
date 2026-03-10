<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\DetalleVentasModel;

class Ventas extends BaseController
{
public function index()
{
    $ventasModel = new VentasModel();
    
    // Traer ventas con JOIN para obtener nombres
    $ventas = $ventasModel
        ->select('ventas.*, 
                  clientes.nombre as cliente_nombre, 
                  clientes.documento as cliente_documento,
                  usuarios.nombre as cajero_nombre')
        ->join('clientes', 'clientes.id_cliente = ventas.id_cliente', 'left')
        ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario', 'left')
        ->where('ventas.estado', 1)
        ->orderBy('ventas.id_venta', 'DESC')
        ->findAll();
    
    $data = [
        'ventas' => $ventas
    ];
    
    return view('ventas/index', $data);
}
    
    public function detalle($id)
    {
        $ventasModel = new VentasModel();
        $detalleModel = new DetalleVentasModel();
        
        // Obtener la venta
        $venta = $ventasModel
            ->select('ventas.*, clientes.nombre as cliente_nombre, clientes.documento, usuarios.nombre as cajero_nombre')
            ->join('clientes', 'clientes.id_cliente = ventas.id_cliente', 'left')
            ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario', 'left')
            ->find($id);
        
        if (!$venta) {
            return redirect()->to('/ventas')->with('error', 'Venta no encontrada');
        }
        
        // Obtener productos de la venta
        $productos = $detalleModel
            ->select('detalle_ventas.*, productos.nombre as producto_nombre, productos.codigo')
            ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
            ->where('detalle_ventas.id_venta', $id)
            ->findAll();
        
        $data['venta'] = $venta;
        $data['productos'] = $productos;
        
        return view('ventas/detalle', $data);
    }

    public function imprimir($idVenta)
{
    $ventasModel = new VentasModel();
    $detalleVentasModel = new DetalleVentasModel();
    
    // Obtener venta
    $venta = $ventasModel
        ->select('ventas.*, 
                  clientes.nombre as cliente_nombre, 
                  clientes.documento,
                  usuarios.nombre as cajero_nombre')
        ->join('clientes', 'clientes.id_cliente = ventas.id_cliente', 'left')
        ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario', 'left')
        ->find($idVenta);
    
    if (!$venta) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Venta no encontrada');
    }
    
    // Obtener productos
    $detalles = $detalleVentasModel
        ->select('detalle_ventas.*, productos.nombre as producto_nombre, productos.codigo')
        ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
        ->where('id_venta', $idVenta)
        ->findAll();
    
    $data = [
        'venta' => $venta,
        'detalles' => $detalles
    ];
    
    return view('ventas/imprimir', $data);
}

public function anular($idVenta)
{
    $ventasModel = new VentasModel();
    $productosModel = new \App\Models\ProductosModel();
    $detalleVentasModel = new DetalleVentasModel();
    
    // Verificar que la venta exista
    $venta = $ventasModel->find($idVenta);
    
    if (!$venta) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Venta no encontrada'
        ]);
    }
    
    if ($venta['estado'] == 0) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'La venta ya está anulada'
        ]);
    }
    
    // Obtener productos para devolver al stock
    $detalles = $detalleVentasModel->where('id_venta', $idVenta)->findAll();
    
    // Iniciar transacción
    $db = \Config\Database::connect();
    $db->transStart();
    
    // Anular la venta
    $ventasModel->update($idVenta, ['estado' => 0]);
    
    // Devolver productos al inventario
    foreach ($detalles as $detalle) {
        $producto = $productosModel->find($detalle['id_producto']);
        if ($producto) {
            $nuevoStock = $producto['stock'] + $detalle['cantidad'];
            $productosModel->update($detalle['id_producto'], ['stock' => $nuevoStock]);
        }
    }
    
    $db->transComplete();
    
    if ($db->transStatus() === false) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Error al anular la venta'
        ]);
    }
    
    return $this->response->setJSON([
        'success' => true,
        'message' => 'Venta anulada exitosamente'
    ]);
}
}