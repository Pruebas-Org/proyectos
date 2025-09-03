<?php

namespace App\Models;

use CodeIgniter\Model;

class asistenciaModel extends Model
{
    protected $table = 'Asistencia';
    protected $primaryKey = 'IdAsistencia';
    protected $allowedFields = ['IdUsuarios','Fecha','HorarioInicial','HorarioFinal','HorasTrabajadas','Status','session_token'];
    protected $returnType = 'App\Entities\asistencia'; // Tipo de entidad que devuelve el modelo

    public function nuevaAsistencia($idUs, $fecha, $horaIn,$sessionToken){

         $data = [
             'IdUsuarios' => $idUs,
             'Fecha' => $fecha,
             'HorarioInicial' => $horaIn,
             'Status' => 'en_trabajo',
             'session_token' => $sessionToken
             ];
             $this->insert($data);
             return $this->db->insertID();
    }

    public function finalizarAsistencia($idasistencia, $fecha, $horaFin, $horasTrab,$sessionToken) {
        // Actualizar la tabla Asistencia donde este exista $idAsistencia
        $update = $this->set('HorarioFinal', $horaFin)
                        ->set('HorasTrabajadas', $horasTrab)
                        ->set('Status', 'fuera_trabajo')
                        ->where('session_token', $sessionToken)
                        ->update();
        //si $fin es correcto returno ok
        return $update ? 'ok' : 'error';
    }

    public function starHour($idUs, $fecha,$sessionToken){

        //obterner HorarioInicial 
        $starHour = $this->select('HorarioInicial')
                            ->where('IdUsuarios',$idUs)
                            ->where('Fecha',$fecha)
                            ->where('Status', 'en_trabajo')
                            ->where('session_token', $sessionToken)
                            ->first();
        //si $starHour es correcto returno ok
        if($starHour === null){
            return $starHour;
        }else{
            return $starHour;
        }

        
    }

        public function getAsistenciaById($idUs) {
  
    // Selecciona todas las horas trabajadas del usuario por su ID
        $query = $this->select('Fecha, HorarioInicial, HorarioFinal')
                      ->where('IdUsuarios', $idUs)

                      //todo los registros array
                        ->findAll();

        return $query;
    }

    public function verfAsAct($sessionToken){
        $activo = $this->where('Status', 'fuera_trabajo')
                        ->where('session_Token', $sessionToken)
                        ->first();
        
        return $activo ? 'ok' : 'error';

    }

    public function getWorkingUser(){
        $count = $this->where('Status', 'en_trabajo')
                    ->where('deleted_at', null)
                      ->countAllResults();
        return $count;
    }
    public function getholidaysUser(){
        $count = $this->where('Status', 'vacaciones')
                    ->where('deleted_at', null)
                      ->countAllResults();
        return $count;
    }


}