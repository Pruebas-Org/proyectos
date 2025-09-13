<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosHorariosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'IdUsuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'IdHorarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'dias' => [
                'type' => 'JSON',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('Id');
        $this->forge->addForeignKey('IdUsuarios', 'Usuarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('IdHorarios', 'Horarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('UsuariosHorarios');
        // Ejecutar los seeders automáticamente después del último migrate
        if (class_exists('CodeIgniter\CLI\CLI')) {
            \CodeIgniter\CLI\CLI::write('Ejecutando seeders...');
            shell_exec('php spark db:seed DatabaseSeeder');
        }
    }

    public function down()
    {
        $this->forge->dropTable('UsuariosHorarios');
    }
}
