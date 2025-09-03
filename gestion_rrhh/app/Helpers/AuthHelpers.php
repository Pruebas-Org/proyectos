<?php

if (! function_exists('isLoggedIn')) {
    // Función para verificar si el usuario está autenticado
    function isLoggedIn()
    {
        $session = session();

        return $session->has('logged_in') && $session->get('logged_in');
    }
}
