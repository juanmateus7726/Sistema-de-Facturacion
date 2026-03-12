<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario esta autenticado
        if (!session()->get('logged_in')) {
            // Guardar la URL que intentaba acceder
            session()->set('redirect_url', current_url());

            // Redirigir al login
            return redirect()->to('/login')->with('error', 'Debe iniciar sesion para acceder');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}