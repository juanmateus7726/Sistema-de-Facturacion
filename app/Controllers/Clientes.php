<?php

namespace App\Controllers;

use App\Models\ClientesModel;

/**
 * Controlador de Clientes
 * Gestiona el CRUD completo de clientes
 */
class Clientes extends BaseController
{
    /**
     * Método index
     * Muestra la lista de todos los clientes
     */
    public function index()
    {
        $model = new ClientesModel();
        $data['clientes'] = $model->findAll();
        
        return view('clientes/index', $data);
    }
    
    /**
     * Método crear
     * Muestra el formulario para crear un nuevo cliente
     */
    public function crear()
    {
        return view('clientes/crear');
    }
    
    /**
     * Método guardar
     * Procesa el formulario y guarda el nuevo cliente
     */
    public function guardar()
    {
        $model = new ClientesModel();
        
        // Reglas de validación
        $reglas = [
            'documento' => [
                'rules' => 'required|min_length[5]|is_unique[clientes.documento]',
                'errors' => [
                    'required' => 'El documento es obligatorio',
                    'min_length' => 'El documento debe tener al menos 5 caracteres',
                    'is_unique' => 'Este documento ya está registrado'
                ]
            ],
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El nombre es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres'
                ]
            ],
            'telefono' => [
                'rules' => 'permit_empty|min_length[7]',
                'errors' => [
                    'min_length' => 'El teléfono debe tener al menos 7 dígitos'
                ]
            ],
            'correo' => [
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Debe ingresar un email válido'
                ]
            ]
        ];
        
        // Validar
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar datos
        $datos = [
            'documento' => $this->request->getPost('documento'),
            'nombre' => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'correo' => $this->request->getPost('correo')
        ];
        
        // Insertar
        if ($model->insert($datos)) {
            return redirect()->to('/clientes')->with('success', 'Cliente creado exitosamente');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al crear el cliente');
        }
    }
    
    /**
     * Método editar
     * Muestra el formulario para editar un cliente existente
     */
    public function editar($id)
    {
        $model = new ClientesModel();
        $cliente = $model->find($id);
        
        if (!$cliente) {
            return redirect()->to('/clientes')->with('error', 'Cliente no encontrado');
        }
        
        $data['cliente'] = $cliente;
        return view('clientes/editar', $data);
    }
    
    /**
     * Método actualizar
     * Procesa el formulario y actualiza el cliente
     */
    public function actualizar($id)
    {
        $model = new ClientesModel();
        
        if (!$model->find($id)) {
            return redirect()->to('/clientes')->with('error', 'Cliente no encontrado');
        }
        
        // Reglas de validación
        $reglas = [
            'documento' => [
                'rules' => "required|min_length[5]|is_unique[clientes.documento,id_cliente,$id]",
                'errors' => [
                    'required' => 'El documento es obligatorio',
                    'min_length' => 'El documento debe tener al menos 5 caracteres',
                    'is_unique' => 'Este documento ya está registrado'
                ]
            ],
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El nombre es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres'
                ]
            ],
            'telefono' => [
                'rules' => 'permit_empty|min_length[7]',
                'errors' => [
                    'min_length' => 'El teléfono debe tener al menos 7 dígitos'
                ]
            ],
            'correo' => [
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Debe ingresar un email válido'
                ]
            ]
        ];
        
        // Validar
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar datos
        $datos = [
            'documento' => $this->request->getPost('documento'),
            'nombre' => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'correo' => $this->request->getPost('correo')
        ];
        
        // Actualizar
        if ($model->update($id, $datos)) {
            return redirect()->to('/clientes')->with('success', 'Cliente actualizado exitosamente');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el cliente');
        }
    }
    
    /**
     * Método eliminar
     * Elimina un cliente
     */
    public function eliminar($id)
    {
        $model = new ClientesModel();
        
        if (!$model->find($id)) {
            return redirect()->to('/clientes')->with('error', 'Cliente no encontrado');
        }
        
        // Eliminar (puedes cambiar a desactivar si prefieres)
        if ($model->delete($id)) {
            return redirect()->to('/clientes')->with('success', 'Cliente eliminado exitosamente');
        } else {
            return redirect()->to('/clientes')->with('error', 'Error al eliminar el cliente');
        }
    }
}