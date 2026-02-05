<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    protected $allowedFields = ['numero_compra', 'fecha_hora', 'id_proveedor', 'id_usuario', 'subtotal', 'iva', 'total', 'estado'];
    protected $useTimestamps = false;
}