<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateNotificacionesTable extends Migration
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
            'IdUsuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'TipoNotificacion' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'contenido' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => false,
            ],
            'leido' => [
                'type' => 'INT',
                'constraint' => 1,
                'null' => false,
                'default' => 0,
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
        $this->forge->addForeignKey('IdUsuario', 'Usuarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('TipoNotificacion', 'TiposNotificaciones', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Notificaciones');
    }
    public function down()
    {
        $this->forge->dropTable('Notificaciones');
    }
}
