<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $usuariosModel = new UsuariosModel();
        
        $data = [
            'usuarios' => $usuariosModel->findAll()
        ];
        
        return view('usuarios/index', $data);
    }
    
    public function crear()
    {
        return view('usuarios/crear');
    }
    
    public function guardar()
{
    $usuariosModel = new UsuariosModel();
    
    $nombre = trim($this->request->getPost('nombre'));
    $usuario = trim($this->request->getPost('usuario'));
    $password = $this->request->getPost('password');
    $rol = $this->request->getPost('rol');
    
    // Validación básica (solo verificar que no estén vacíos)
    if (empty($nombre) || empty($usuario) || empty($password) || empty($rol)) {
        return redirect()->back()
                       ->withInput()
                       ->with('error', 'Todos los campos son obligatorios');
    }
    
    // Hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    $data = [
        'nombre' => $nombre,
        'usuario' => $usuario,
        'contrasena' => $passwordHash,
        'rol' => $rol,
        'estado' => 1
    ];
    
    try {
        $usuariosModel->insert($data);
        return redirect()->to('/usuarios')->with('success', 'Usuario creado exitosamente');
    } catch (\ReflectionException $e) {
        // Error de MySQL por UNIQUE, NOT NULL, etc.
        $errorMessage = $e->getMessage();
        
        // Hacer el mensaje más amigable
        if (strpos($errorMessage, 'Duplicate entry') !== false) {
            $errorMessage = 'El nombre de usuario ya existe';
        } elseif (strpos($errorMessage, 'cannot be null') !== false) {
            $errorMessage = 'Todos los campos son obligatorios';
        }
        
        return redirect()->back()
                       ->withInput()
                       ->with('error', $errorMessage);
    }
}
    
    public function editar($id)
    {
        $usuariosModel = new UsuariosModel();
        
        $data = [
            'usuario' => $usuariosModel->find($id)
        ];
        
        if (!$data['usuario']) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }
        
        return view('usuarios/editar', $data);
    }
    
    public function actualizar($id)
    {
        $usuariosModel = new UsuariosModel();
        
        $nombre = $this->request->getPost('nombre');
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $rol = $this->request->getPost('rol');
        $estado = $this->request->getPost('estado');
        
        $data = [
            'nombre' => $nombre,
            'usuario' => $usuario,
            'rol' => $rol,
            'estado' => $estado
        ];
        
        // Si se ingresó una nueva contraseña, hashearla
        if (!empty($password)) {
            $data['contrasena'] = password_hash($password, PASSWORD_BCRYPT);
        }
        
        if ($usuariosModel->update($id, $data)) {
            return redirect()->to('/usuarios')->with('success', 'Usuario actualizado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }
    }
    
    public function eliminar($id)
    {
        $usuariosModel = new UsuariosModel();
        
        // No permitir eliminar al propio usuario
        if ($id == session()->get('id_usuario')) {
            return redirect()->back()->with('error', 'No puede eliminarse a sí mismo');
        }
        
        // Cambiar estado a 0 en lugar de eliminar
        if ($usuariosModel->update($id, ['estado' => 0])) {
            return redirect()->to('/usuarios')->with('success', 'Usuario desactivado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al desactivar el usuario');
        }
    }
}