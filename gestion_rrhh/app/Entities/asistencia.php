<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class asistencia extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'IdAsistencia' => null,
        'IdUsuarios' => null,
        'Fecha' => null,
        'HorarioInicial' => null,
        'HorarioFinal' => null,
        'HorasTrabajadas' => null,
        'Status' => null,
        'session_token' => null
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
