<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $model = new UsuariosModel();
        $data['usuarios'] = $model->findAll();
        return view('usuarios/index', $data);
    }
}