<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class modulos extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'Id' => null,
        'NombreItem' => null,
        'Ruta' => null,
        'TipoUsuario' => null,
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
