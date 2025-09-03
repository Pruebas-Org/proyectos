<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoauthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario no está autenticado
        if (session()->has('user_id'))  { 
            // Si no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->to('/dashboard');
        }

        // Si está autenticado, permitir el acceso
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       // Verificar si el usuario no está autenticado
       if (session()->has('user_id'))  { 
        // Si no está autenticado, redirigir a la página de inicio de sesión
        return redirect()->to('/dashboard');
    }

    // Si está autenticado, permitir el acceso
    return;
    }
}
