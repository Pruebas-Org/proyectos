<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserSchedules extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'Id' => null,
        'IdUsuarios' => null,
        'IdHorarios' => null,
        'dias' => null
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
