<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateModulosTable extends Migration
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
            'NombreItem' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Ruta' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'Icono' => [
                'type' => 'VARCHAR',
                'constraint' => 50, // Ajusta el tamaño según el nombre del icono de Font Awesome
                'null' => true,
            ],
            'TipoUsuario' => [
                'type' => 'JSON',
                'null' => true,
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
        $this->forge->createTable('Modulos');
    }

    public function down()
    {
        $this->forge->dropTable('Modulos');
    }
}
