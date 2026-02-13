<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleComprasModel extends Model
{
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id_detalle_compra';
    protected $allowedFields = ['id_compra', 'id_producto', 'cantidad', 'precio_compra', 'subtotal'];
    protected $useTimestamps = false;
}