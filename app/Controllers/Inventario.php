<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Inventario extends BaseController
{
    public function index()
    {
        $model = new ProductosModel();
        
        // Traer productos con categoría
        $productos = $model
            ->select('productos.*, categorias.nombre as categoria_nombre')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->where('productos.estado', 1)
            ->orderBy('productos.stock', 'ASC')
            ->findAll();
        
        // Calcular estadísticas
        $totalProductos = count($productos);
        $stockBajo = 0;
        $sinStock = 0;
        
        foreach ($productos as $producto) {
            if ($producto['stock'] <= 0) {
                $sinStock++;
            } elseif ($producto['stock'] <= $producto['stock_minimo']) {
                $stockBajo++;
            }
        }
        
        $data['productos'] = $productos;
        $data['totalProductos'] = $totalProductos;
        $data['stockBajo'] = $stockBajo;
        $data['sinStock'] = $sinStock;
        
        return view('inventario/index', $data);
    }
}