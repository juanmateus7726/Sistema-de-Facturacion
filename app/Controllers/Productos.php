<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class Productos extends BaseController
{
    public function index()
    {
        $model = new ProductosModel();
        $data['productos'] = $model->findAll();
        return view('productos/index', $data);
    }
}