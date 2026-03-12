<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $rol = session()->get('rol');
        
        // Si no hay argumentos, permitir acceso
        if (empty($arguments)) {
            return;
        }
        
        // Verificar si el rol del usuario está en los roles permitidos
        if (!in_array($rol, $arguments)) {
            // Redirigir según el rol
            switch ($rol) {
                case 'cajero':
                    $redirectUrl = '/pos';
                    break;
                case 'gerente':
                case 'admin':
                    $redirectUrl = '/dashboard';
                    break;
                default:
                    $redirectUrl = '/login';
                    break;
            }
            
            return redirect()->to($redirectUrl)
                             ->with('error', 'No tiene permisos para acceder a esa página.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No hacer nada después
    }
}