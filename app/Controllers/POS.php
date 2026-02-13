<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ClientesModel;
use App\Models\VentasModel;
use App\Models\DetalleventasModel;

class POS extends BaseController
{
    public function index()
    {
        return view('pos/index');
    }
    public function bucarProducto()
    {
    }
    public function guardarVenta()
    {
    }
    public function imprimirTicket($id_venta)
    {
    }
}