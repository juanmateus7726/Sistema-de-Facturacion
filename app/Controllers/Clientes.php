<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Clientes extends BaseController
{
    public function index()
    {
        $model = new ClientesModel();
        $data['clientes'] = $model->findAll();
        return view('clientes/index', $data);
    }
}