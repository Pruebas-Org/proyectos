<?php

namespace App\Models;

use CodeIgniter\Model;

class userHorariosModel extends Model
{
    protected $table = 'UsuariosHorarios';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['IdUsuarios','IdHorarios','dias'];
    protected $returnType = 'App\Entities\UserSchedules'; // Tipo de entidad que devuelve el modelo

    public function newUserHorarios($horario,$idUser){
        foreach($horario as $datos)
        {
        $Idhorarios = $datos['id'];
        $dias = $datos['dias'];

        //guardar los datos y devolver el id
        $id = $this->insert([
            'IdUsuarios' => $idUser,
            'IdHorarios' => $Idhorarios,
            'dias' => $dias,
            ]);
        }
    }

}