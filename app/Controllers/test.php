<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        if ($db ->connect()) {
            echo "🟢 Conexion exitosa a la base de datos!<br>";
            echo "Base de datos: " . $db->database;
        } else {
            echo "🔴 Error de conexion";
        }
    }
}