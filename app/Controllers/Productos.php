<?php

namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\ProductosModel;

class Productos extends BaseController
{
    public function index()
    {
        // Crear instancia del modelo
        $model = new ProductosModel();

        // Obtener todos los productos con informacion de categoria
        // Usamos join para traer el nombre de la categoria
        $productos = $model
            -> select('productos.*, categorias.nombre as categoria_nombre')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->findAll();
        
            // Enviar datos a la vista
            $data['productos'] = $productos;

            return view('productos/index', $data);
    }
    /**
     * Muestra el formulario para crear un nuevo producto
     */
    public function crear()
    {
        // Cargar las categorias para el select
        $categoriasModel = new CategoriasModel();
        $data['categorias'] = $categoriasModel->findAll();

        return view('productos/crear', $data);
    }

    /**
     * Procesa el formulario y guarda el nuevo producto
     */
    public function guardar()
    {
        // crear instancia del modelo
        $model = new ProductosModel();

        // Definir reglas de validacion
        $reglas = [
            'codigo' => [
                'rules' => 'required|min_length[3]|is_unique[productos.codigo]',
                'errors' => [
                    'required' => 'El codigo es obligatorio',
                    'min_length' => 'El codigo debe de tener al menos 3 caracteres',
                    'is_unique' => 'Este codigo ya existe'
                ]
            ],
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El nombre es obligatorio',
                    'min_length' => 'El nombre debe de tener al menos 3 caracteres'
                ]
            ],
            'precio' => [
                'rules' => 'required|decimal|greater_than[0]',
                'errors' => [
                    'required' => 'El precio es obligatorio',
                    'decimal' => 'El precio debe de ser un numero valido',
                    'greater_than' => 'El precio debe de ser mayor a 0'
                ]
            ],
            'precio_compra' => [
                'rules' => 'required|decimal|greater_than[0]',
                'errors' => [
                    'required' => 'El precio de compra es obligatorio',
                    'decimal' => 'El precio de compra debe de ser un numero valido',
                    'greater_than' => ' El precio de compra debe de ser mayor a 0'
                ]
            ],
            'stock' => [
                'rules' => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required' => 'El stock es obligatorio',
                    'integer' => 'El stock minimo debe de ser un numero entero',
                    'greater_than_equal_to' => 'El stock minimo no puede ser negativo'
                ] 
            ],
            'id_categoria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Debe seleccionar una categoria'
                ]
            ]
        ];

        // Validar los datos
        if (!$this->validate($reglas)) {
            // Si hay errores, volver al formulario con los errores
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Preparar datos para insertar
        $datos = [
            'codigo' => $this->request->getPost('codigo'),
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'precio_compra' => $this->request->getPost('precio_compra'),
            'stock' => $this->request->getPost('stock'),
            'stock_minimo' => $this->request->getPost('stock_minimo'),
            'id_categoria' => $this->request->getPost('id_categoria'),
            'estado' => 1 // Activo por defecto
        ];

        // Insertar en la base de datos
        if ($model->insert($datos)) {
            // Si se inserto correctamente, redirigir con mensaje de exito
            return redirect()->to('/productos')->with('success', 'Producto creado exitosamente');
        } else {
            // Si ubo error, volver con mensaje de error
            return redirect()->back()->withInput()->with('error', 'Error al crear el producto');
        }
    }

    /**
     * Muestra el formulario para editar un producto existente
     */
    public function editar($id)
    {
        $model = new ProductosModel();

        // Buscar el producto
        $producto = $model->find($id);

        // Verificar que exista
        if (!$producto) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado');
        }

        // Cargar categorias para el select
        $categoriasModel = new CategoriasModel();
        $data['categorias'] = $categoriasModel->findAll();
        $data['producto'] = $producto;

        return view('productos/editar', $data);
    }

    /**
     * Procesa el formulario y actualiza el producto
     */
    public function actualizar($id)
    {

    $model = new ProductosModel();

    // Verificar que el producto exista
    if (!$model->find($id)) {
        return redirect()->to('/productos')->with('error', 'Prodducto no encontrado');
    }

    // Reglas de validacion (similar a guardar, pero el codigo puede repetirse si es el mismo producto)
    $reglas = [
        'codigo' => [
            'rules' => 'required|min_length[3]|is_unique[productos.codigo,id_producto,$id]',
            'errors' => [
                'required' => 'El codigo es obligatorio',
                'min_length' => 'El codigo debe de tener al menos 3 caracteres',
                'is_unique' => 'Este codigo ya existe'
            ]
        ],
        'nombre' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El nombre es obligatorio',
                'min_length' => 'El nombre debe de tener al menos 3 caracteres'
            ]
        ],
        'precio' => [
            'rules' => 'required|decimal|greater_than[0]',
            'errors' => [
                'required' => 'El precio es obligatorio',
                'decimal' => 'El precio debe de ser un numero valido',
                'greater_than' => 'El precio debe ser mayor a 0'
            ]
        ],
        'precio_compra' => [
            'rules' => 'required|decimal|greater_than[0]',
            'errors' => [
                'required' => 'El precio de compra es obligatorio',
                'decimal' => 'El precio de compra debe de ser un numero valido',
                'greater_than' => 'El precio de compra debe de ser mayor a 0'
            ]
        ],
        'stock' => [
            'rules' => 'required|integer|greater_than_equal_to[0]',
            'errors' => [
                'required' => 'El stock es obligatorio',
                'integer' => 'El stock minimo debe de ser un numero entero',
                'greater_than_equal_to' => 'El stock minimo no puede ser negativo'
            ]
        ],
        'id_categoria' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Debe seleccionar una categoria'
            ]
        ]
    ];

    // Validar
    if (!$this->validate($reglas)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Preparar datos
    $datos = [
        'codigo' => $this->request->getPost('codigo'),
        'nombre' => $this->request->getPost('nombre'),
        'precio' => $this->request->getPost('precio'),
        'precio_compra' => $this->request->getPost('precio_compra'),
        'stock' => $this->request->getPost('stock'),
        'stock_minimo' => $this->request->getPost('stock_minimo'),
        'id_categoria' => $this->request->getPost('id_categoria'),
    ];

    // Actualizar
    if ($model->update($id, $datos)) {
        return redirect()->to('/productos')->with('success', 'Producto actualizado exitosamente');
    } else {
        return redirect()->back()->withInput()->with('error', 'Error al actualizar el producto');
        }
    }

    /**
     * Elimina (o desactiva) un producto
     */
    public function eliminar($id)
    {
        $model = new ProductosModel();

        // Verificar que exista
        $producto = $model->find($id);
        if (!$producto) {
            return redirect()->to('/productos')->with('error', 'Producto no encontrado');
        }

        // En lugar de eliminar fisicamente, desactivar el producto
        // Esto mantiene el historico de ventas
        if ($model->update($id, ['estado' => 0])) {
            return redirect()->to('/productos')->with('success', 'Producto eliminado exitosamente');
        } else {
            return redirect()->to('/productos')->with('error', 'Error al eliminar el producto');
        }
    }
}