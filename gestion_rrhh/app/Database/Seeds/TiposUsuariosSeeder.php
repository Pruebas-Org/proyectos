<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class TiposUsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'Nombre'      => 'Administrador',
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'Nombre'      => 'Empleado',
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
            [
                'Nombre'      => 'Supervisor',
                'created_at'  => Time::now(),
                'updated_at'  => Time::now(),
            ],
        ];
        $this->db->table('TiposUsuarios')->insertBatch($data);
    }
}
