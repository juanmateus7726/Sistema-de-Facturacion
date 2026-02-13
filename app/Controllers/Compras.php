<?php

namespace App\Controllers;

use App\Models\ComprasModel;

class Compras extends BaseController
{
    public function index()
    {
        $model = new ComprasModel();
        $data['compras'] = $model->findAll();
        return view('compras/index', $data);
    }
}