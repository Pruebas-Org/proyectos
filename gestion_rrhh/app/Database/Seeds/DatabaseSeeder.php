<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // El orden es importante para respetar las claves foráneas
    $this->call('TiposUsuariosSeeder');
    $this->call('EquipoSeeder');
    $this->call('AdminUserSeeder');
    $this->call('ModulosSeeder');
        // Agrega aquí otros seeders si los necesitas, por ejemplo:
        // $this->call('EquipoSeeder');
        // $this->call('TiposEventosSeeder');
        // $this->call('TiposNotificacionesSeeder');
    }
}
