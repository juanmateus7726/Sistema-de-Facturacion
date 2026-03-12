<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        // Si ya está logueado, redirigir al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        return view('login/index');
    }
    
public function autenticar()
{
    $usuario = $this->request->getPost('usuario');
    $password = $this->request->getPost('password');
    
    if (empty($usuario) || empty($password)) {
        return redirect()->back()->with('error', 'Ingrese usuario y contraseña');
    }
    
    $usuariosModel = new UsuariosModel();
    
    $usuarioData = $usuariosModel->where('usuario', $usuario)
                                 ->where('estado', 1)
                                 ->first();
    
    if (!$usuarioData) {
        return redirect()->back()->with('error', 'Usuario no encontrado o inactivo');
    }
    
    if (!password_verify($password, $usuarioData['contrasena'])) {
        return redirect()->back()->with('error', 'Contraseña incorrecta');
    }
    
    $sessionData = [
        'id_usuario' => $usuarioData['id_usuario'],
        'nombre' => $usuarioData['nombre'],
        'usuario' => $usuarioData['usuario'],
        'rol' => $usuarioData['rol'],
        'logged_in' => true
    ];
    
    session()->set($sessionData);
    
    $usuariosModel->update($usuarioData['id_usuario'], [
        'ultimo_acceso' => date('Y-m-d H:i:s')
    ]);
    
    return redirect()->to('/dashboard')->with('success', '¡Bienvenido!');
}

public function logout()
{
    session()->destroy();
    return redirect()->to('/login')->with('success', 'Sesión cerrada correctamente');
}
}