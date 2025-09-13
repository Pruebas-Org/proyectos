<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class EquipoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'NombreEquipo' => 'Administración',
                'created_at'   => Time::now(),
                'updated_at'   => Time::now(),
            ],
            [
                'NombreEquipo' => 'RRHH',
                'created_at'   => Time::now(),
                'updated_at'   => Time::now(),
            ],
            [
                'NombreEquipo' => 'IT',
                'created_at'   => Time::now(),
                'updated_at'   => Time::now(),
            ],
        ];
        $this->db->table('Equipo')->insertBatch($data);
    }
}
