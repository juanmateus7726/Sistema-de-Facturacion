<?php

namespace App\Controllers;

use App\Models\ProveedoresModel;

class Proveedores extends BaseController
{
    public function index()
    {
        $model = new ProveedoresModel();
        $data['proveedores'] = $model->findAll();
        return view('proveedores/index', $data);
    }
}