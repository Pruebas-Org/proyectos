<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateHorariosTable extends Migration
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
            'HoraInicio' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'HoraFinal' => [
                'type' => 'TIME',
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
        $this->forge->createTable('Horarios');
    }
    public function down()
    {
        $this->forge->dropTable('Horarios');
    }
}
