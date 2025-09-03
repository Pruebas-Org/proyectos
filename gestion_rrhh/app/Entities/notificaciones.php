<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class notificaciones extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'Id' => null,
        'IdUsuario' => null,
        'TipoNotificacion' => null,
        'contenido' => null,
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
