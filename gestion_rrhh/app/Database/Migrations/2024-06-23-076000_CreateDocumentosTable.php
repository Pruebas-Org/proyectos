<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateDocumentosTable extends Migration
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
            'Descripcion' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'IdUsuario' => [
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
        $this->forge->addForeignKey('IdUsuario', 'Usuarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Documentos');
    }
    public function down()
    {
        $this->forge->dropTable('Documentos');
    }
}
