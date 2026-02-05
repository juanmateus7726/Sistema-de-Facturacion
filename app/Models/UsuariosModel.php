<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey ='id_usuario';
    protected $allowedFields = ['nombre', 'usuarios', 'contrasena', 'rol', 'estado'];
    protected $useTimestamps = false;
}