<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
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
            'session_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'Nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'Apellido' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'Email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'Password' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'FechaNacimiento' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'FechaIngreso' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'Telefono' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'TipoUsuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'IdEquipo' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('Id');
        $this->forge->addForeignKey('TipoUsuario', 'TiposUsuarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('IdEquipo', 'Equipo', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('Usuarios');
    }
}
