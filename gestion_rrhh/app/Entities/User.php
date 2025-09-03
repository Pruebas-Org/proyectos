<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    // Define los campos de la tabla usuarios
    protected $attributes = [
        'Id' => null,
        'Nombre' => null,
        'Apellido' => null,
        'Email' => null, 
        'Password' => null, 
        'FechaNacimineto' => null, 
        'TipoUsuario' => null, 
        'foto'=>null,
        'idEquipo' => null,
        'session_token' =>null
    ];

    // Opcional: Si tienes campos adicionales en tu tabla, agrégalos aquí o define métodos para acceder a ellos.
}
