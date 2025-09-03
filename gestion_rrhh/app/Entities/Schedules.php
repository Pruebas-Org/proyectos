<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Schedules extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'Id' => null,
        'HoraInicio' => null,
        'HoraFinal' => null,
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
