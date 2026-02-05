<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $allowedFields = ['numero_factura', 'fecha_hora', ' id_cliente', 'id_usuario', 'subtotal', 'descuento_total', 'iva', 'total', 'metodo_pago', 'monto_recibido', 'cambio', 'estado'];
    protected $useTimestamps = false;
}