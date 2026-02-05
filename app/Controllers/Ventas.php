<?php

namespace App\Controllers;

use App\Models\VentasModel;

class Ventas extends BaseController
{
    public function index()
    {
        return view('ventas/index');
    }
}