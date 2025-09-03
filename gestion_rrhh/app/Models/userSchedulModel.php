<?php

namespace App\Models;

use CodeIgniter\Model;

class userSchedulModel extends Model
{
    protected $table = 'Horarios';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['HoraInicio','HoraFinal'];
    protected $returnType = 'App\Entities\UserType'; // Tipo de entidad que devuelve el modelo

    public function getSchedules(){
            //obtener todos los datos
        $data = $this->where('deleted_at', null)
                    ->findAll();
        return $data;
        
    }

    //funcion para obtener la deferencia entre HoraFinal y HoraInicio 
//     SELECT 
//     Horarios.HoraInicio, Horarios.HoraFinal, TIMEDIFF(Horarios.HoraFinal, Horarios.HoraInicio) AS Diferencia, UsuariosHorarios.IdUsuarios, UsuariosHorarios.dias
// FROM 
//     Horarios
// INNER JOIN UsuariosHorarios ON UsuariosHorarios.IdHorarios = Horarios.Id;
public function getScheduleDifference($id){
    $data = $this->select('Horarios.HoraInicio, Horarios.HoraFinal
    , TIMEDIFF(Horarios.HoraFinal, Horarios.HoraInicio) AS Diferencia
    , UsuariosHorarios.IdUsuarios, UsuariosHorarios.dias')
    ->join('UsuariosHorarios', 'UsuariosHorarios.IdHorarios = Horarios.Id')
    ->where('UsuariosHorarios.IdUsuarios', $id)
    ->findAll();
    return $data;
    }

}