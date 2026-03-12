<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;

class Dashboard extends BaseController
{
    public function index()
{
    $ventasModel = new VentasModel();
    $productosModel = new ProductosModel();
    
    // Obtener fecha de hoy
    $hoy = date('Y-m-d');
    
    // VENTAS DE HOY
    $ventasHoy = $ventasModel->select('SUM(total) as total_ventas, COUNT(*) as total_facturas')
                             ->where('DATE(fecha_hora)', $hoy)
                             ->where('estado', 1)
                             ->first();
    
    // TOTAL DE PRODUCTOS
    $totalProductos = $productosModel->where('estado', 1)->countAllResults();
    
    // PRODUCTOS CON STOCK BAJO (menos de 10 unidades)
    $stockBajo = $productosModel->where('stock <', 10)
                                ->where('estado', 1)
                                ->countAllResults();
    
    $data = [
        'ventas_hoy' => $ventasHoy['total_ventas'] ?? 0,
        'facturas_hoy' => $ventasHoy['total_facturas'] ?? 0,
        'total_productos' => $totalProductos,
        'stock_bajo' => $stockBajo
    ];
    
    return view('dashboard', $data);
}
}