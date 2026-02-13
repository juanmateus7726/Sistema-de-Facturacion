<?php
namespace App\Controllers;

use App\Models\ProductosModel;

class Inventario extends BaseController
{
    public function index()
    {
        $model = new ProductosModel();
        $data['productos'] = $model->findAll();
        return view('inventario/index', $data);
    }
}