<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $allowedFields = ['numero_factura', 'fecha_hora', 'id_cliente', 'id_usuario', 'subtotal', 'descuento_total', 'iva', 'total', 'metodo_pago', 'monto_recibido', 'cambio', 'estado', 'pago_mixto_detalle'];
    protected $useTimestamps = false;
    public function generarNumeroFactura()
    {
        //Busca la ultima factura registrada en la BD
        $ultima = $this->orderBy('id_venta', 'DESC')->first();
        if ($ultima) {
            //Si existe una factura anterior, extrae el numero y suma 1
            $numero = intval(substr($ultima['numero_factura'], 4)) + 1;
        } else {
            //Si no hay facturas aun, empieza desde 1
            $numero = 1;
        }
        // Formatea el numero con ceros a la izquierda (0001, 0002, etc)
        //str_pad: rellena con ceros hasta 4 digitos
        return 'FAC' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }
}