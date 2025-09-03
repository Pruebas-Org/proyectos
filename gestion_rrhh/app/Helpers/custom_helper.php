<?php

if (!function_exists('convertDateToYMD')) {
    function convertDateToYMD($date)
    {
        $dateArray = explode('-', $date);
        if (count($dateArray) == 3) {
            return $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
        }
        return false; // Retorna false si el formato no es válido
    }
}

if (!function_exists('generateSessionToken')) {
    function generateSessionToken()
    {
        return bin2hex(random_bytes(16)); // Genera un token aleatorio de 32 caracteres
    }
}


