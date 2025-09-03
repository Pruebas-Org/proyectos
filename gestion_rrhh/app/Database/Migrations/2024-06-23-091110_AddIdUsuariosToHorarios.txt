<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdUsuariosToHorarios extends Migration
{
    public function up()
    {
        // Agregar columna IdUsuarios a la tabla Horarios
        $this->forge->addColumn('Horarios', [
            'IdUsuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);

        // Añadir clave foránea a la columna IdUsuarios
        $this->forge->addForeignKey('IdUsuarios', 'Usuarios', 'Id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Eliminar la columna IdUsuarios y la clave foránea si fuera necesario
        $this->forge->dropForeignKey('Horarios', 'Horarios_IdUsuarios_foreign');
        $this->forge->dropColumn('Horarios', 'IdUsuarios');
    }
}
