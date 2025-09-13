<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class ModulosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'NombreItem'   => 'Lista',
                'Ruta'        => 'list',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Trabajando',
                'Ruta'        => 'online',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Registrar',
                'Ruta'        => 'register',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Permisos',
                'Ruta'        => 'permisos',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Asistencia',
                'Ruta'        => 'asistencia',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Notificación',
                'Ruta'        => 'notificacion',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'NombreItem'   => 'Mensaje',
                'Ruta'        => 'mensaje',
                'TipoUsuario' => json_encode([1]),
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
        ];
        $this->db->table('Modulos')->insertBatch($data);
    }
}
