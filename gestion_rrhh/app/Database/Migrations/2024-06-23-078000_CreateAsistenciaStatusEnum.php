<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class CreateAsistenciaStatusEnum extends Migration
{
    public function up()
    {
        // Solo para MySQL: crear el ENUM como tipo de columna en la migración de Asistencia
        // No se requiere migración separada, pero se deja como referencia
    }
    public function down()
    {
        // No se requiere acción
    }
}
