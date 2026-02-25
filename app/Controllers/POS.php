<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\ClientesModel;
use App\Models\VentasModel;
use App\Models\DetalleVentasModel;

class POS extends BaseController
{
    public function index()
    {
        $clientesModel = new ClientesModel();
        $data['clientes'] = $clientesModel->findAll();

        return view('pos/index', $data);
    }


    public function buscarProducto()
    {
        // Verifica que la peticion sea AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Peticion no valida']);
        }
        //Obtiene el termino de busqeuda desde POST
        $termino = $this->request->getPost('termino');
        //Instancia el modelo de productos
        $productosModel = new ProductosModel();
        //Busca productos que coincidan con el codigo o nombre
        //groupStart y groupEnd crean parentesis en la consulta SQL: WHERE (codigo LIKE '%termino%' OR nombre LIKE '%termino%')
        $productos = $productosModel
        ->groupStart()
            ->like('codigo', $termino)
            ->orLike('nombre', $termino)
        ->groupEnd()
        ->where('estado', 1) // Solo productos activos
        ->where('stock >', 0) //Solo con stock disponible
        ->findAll();

        //Retorna los productos en formato JSON
        return $this->response->setJSON($productos);
    }


    public function guardarVenta()
    {
        //Verifica que sea peticion AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Peticion no valida']);
        }

        //Obtiene los datos del POST
        $id_cliente = $this->request->getPost('id_cliente');
        $id_usuario = $this->request->getPost('id_usuario');
        $productos = json_decode($this->request->getPost('productos'), true); // Convierte JSON a array
        $subtotal = $this->request->getPost('subtotal');
        $descuento_total = $this->request->getPost('descuento_total');
        $iva = $this->request->getPost('iva');
        $total = $this->request->getPost('total');
        $metodo_pago = $this->request->getPost('metodo_pago');
        $monto_recibido = $this->request->getPost('monto_recibido');
        $cambio = $this->request->getPost('cambio');

        //Validaciones basicos
        if (empty($id_cliente) || empty($productos)) {
            return $this->response->setJSON([
                'success' => false,
                'message' =>'Debe seleccionar un cliente y agregar productos'
            ]);
        }

        //Inicializa los modelos necesarios
        $ventasModel = new VentasModel();
        $detalleVentasModel = new DetalleVentasModel();
        $productosModel = new ProductosModel();

        //Inicia una transaccion de base de datos
        //Si algo falla, se revierte todo automaticamente
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            //Llama al metodo que creamos en el modelo
            $numero_factura = $ventasModel->generarNumeroFactura();
            // 1. Guardar la venta (cabecera)
            $dataVenta = [
                'numero_factura' => $numero_factura,
                'fecha_hora' => date('Y-m-d H:i:s'),
                'id_cliente' => $id_cliente,
                'id_usuario' => $id_usuario,
                'subtotal' => $subtotal,
                'descuento_total' => $descuento_total ?? 0,
                'iva' => $iva,
                'total' => $total,
                'metodo_pago' => $metodo_pago,
                'monto_recibido' => $monto_recibido,
                'cambio' => $cambio ?? 0,
                'estado' => 1
            ];
            //Inserta la venta y obtiene el ID generado
            $id_venta = $ventasModel->insert($dataVenta);
            //2. Guardar los productos de la venta (detalle)
            foreach ($productos as $producto) {

            $subtotal_linea = ($producto['precio'] * $producto['cantidad']) - ($producto['descuento'] ?? 0);
                //Inserta cada producto en detalle_ventas
                $dataDetalle = [
                    'id_venta' => $id_venta,
                    'id_producto' => $producto['id_producto'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'descuento_aplicado' =>$producto['descuento'] ?? 0,
                    'subtotal_linea' => $subtotal_linea
                ];
                $detalleVentasModel->insert($dataDetalle);

                //3. Actualizar el stock del producto
                $productoActual = $productosModel->find($producto['id_producto']);
                $nuevoStock = $productoActual['stock'] - $producto['cantidad'];

                //Actualza el stock
                $productosModel->update($producto['id_producto'], [
                    'stock' => $nuevoStock
                ]);
            }
            //Completa la transaccion
            $db->transComplete();
            //Verifica si hubo errores
            if ($db->transStatus() === false) {
                throw new \Exception('Error al procesar la venta');
            }

            // Retorna respuesta exitosa
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Venta registrada exitosamente',
                'id_venta' => $id_venta,
                'numero_factura' => $numero_factura
            ]);
        } catch (\Exception $e) {
            // Si algo falla, retorna el error
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al guardar la venta: ' . $e->getMessage(),
                'db_error' => $dbError ?? null,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }


    public function verificarStock($id_venta)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Peticion no valida']);
        }

        $id_producto = $this->request->getPost('id_producto');
        $cantidad = $this->request->getPost('cantidad');

        $productosModel = new ProductosModel();
        $producto = $productosModel->find($id_producto);

        //Verifica si hay suficiente stock
        if ($producto['stock'] >= $cantidad) {
            return $this->response->setJSON([
                'disponible' => true,
                'stock_actual' => $producto['stock']
            ]);
        } else {
            return $this->response->setJSON([
                'disponible' =>false,
                'stock_actual' => $producto['stock'],
                'message' => 'Stock insuficiente. Disponible: ' . $producto['stock']
            ]);
        }
    }
}