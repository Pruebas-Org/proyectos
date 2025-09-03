<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario no está autenticado
        if (!session()->has('logged_in'))  { 
            // Si no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->to('/');
        }

        // Si está autenticado, permitir el acceso
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Hacer algo después de procesar la solicitud
    }
}
