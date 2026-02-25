<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleVentasModel extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id_detalle';
    protected $allowedFields = ['id_venta', 'id_producto', 'cantidad', 'precio_unitario', 'descuento_aplicado', 'subtotal_linea'];
    protected $useTimestamps = false;
}