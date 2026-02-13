<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\VentasModel;

class Reportes extends BaseController
{
    public function index()
    {
        return view('reportes/index');
    }
}