<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAsistenciaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IdAsistencia' => [
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
            'session_token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'Fecha' => [
                'type' => 'DATE',
            ],
            'HorarioInicial' => [
                'type' => 'TIME',
            ],
            'HorarioFinal' => [
                'type' => 'TIME',
                'null' => true, // Puede ser nulo si el usuario aún no ha terminado su jornada
            ],
            'HorasTrabajadas' => [
                'type' => 'FLOAT',
                'null' => true, // Puede ser nulo si el usuario aún no ha terminado su jornada
            ],
            'Status' => [
                'type' => 'ENUM',
                'constraint' => ['en_trabajo', 'fuera_trabajo'],
                'default' => 'fuera_trabajo',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => false,
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('IdAsistencia', true);
        $this->forge->addForeignKey('IdUsuarios', 'Usuarios', 'Id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Asistencia');
    }

    public function down()
    {
        $this->forge->dropTable('Asistencia');
    }
}
