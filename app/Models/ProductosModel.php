<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey ='id_producto';
    protected $allowedFields = ['codigo', 'nombre', 'precio', 'id_categoria', 'stock', 'stock_minimo', 'precio_compra', 'estado'];
    protected $useTimestamps = false;
}