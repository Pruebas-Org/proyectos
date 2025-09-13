<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        // Busca el primer TipoUsuario y Equipo existentes
        $db = \Config\Database::connect();
        $tipoUsuario = $db->table('TiposUsuarios')->get()->getFirstRow('array');
        $equipo = $db->table('Equipo')->get()->getFirstRow('array');
        $data = [
            'Nombre'        => 'Admin',
            'Apellido'      => 'Principal',
            'Email'         => 'admin@admin.com',
            'Password'      => $password,
            'TipoUsuario'   => $tipoUsuario ? $tipoUsuario['Id'] : 1,
            'IdEquipo'      => $equipo ? $equipo['Id'] : 1,
            'FechaNacimiento' => '1990-01-01',
            'created_at'    => Time::now(),
            'updated_at'    => Time::now(),
        ];
        $db->table('Usuarios')->insert($data);
    }
}
