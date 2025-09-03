<?php

namespace App\Models;

use CodeIgniter\Model;

class notificacionesModel extends Model
{
    protected $table = 'Notificaciones';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['IdUsuario','TipoNotificacion','contenido','leido'];
    protected $returnType = 'App\Entities\notificaciones'; // Tipo de entidad que devuelve el modelo

    public function getNotifications($idUsr){
            //obtener todos los datos
        $data = $this->where('deleted_at', null)
                    ->where('IdUsuario', $idUsr)
                    ->where('TipoNotificacion','1')

                    ->findAll();
        return $data;
    }

    public function getMessage($idUsr){
        //obtener todos los datos
    $data = $this->where('deleted_at', null)
                ->where('IdUsuario', $idUsr)
                ->where('TipoNotificacion','2')

                ->findAll();
    return $data;
}
public function getNewNotifications($idUsr){
            //obtener todos los datos
        $data = $this->where('deleted_at', null)
                    ->where('IdUsuario', $idUsr)
                    ->where('TipoNotificacion','1')
                    ->where('leido','0')
                    ->findAll();
        return $data;
    }

    public function getNewMessage($idUsr){
        //obtener todos los datos
    $data = $this->where('deleted_at', null)
                ->where('IdUsuario', $idUsr)
                ->where('TipoNotificacion','2')
                ->where('leido','0')
                ->findAll();
    return $data;
}

    public function sendNotificacionToUser($idUsuarios,$mensaje,$tipoNotificacion){
        $data = [
            'IdUsuario' => $idUsuarios,
            'TipoNotificacion' => $tipoNotificacion,
            'contenido' => $mensaje
            ];
            $this->insert($data);

    }

    public function countNoti($idUsr){
       
        $data = $this->where('IdUsuario',$idUsr)
        ->where('TipoNotificacion','1')
        ->where('leido','0')
        ->countAllResults();

        return $data;
        }

    public function countMessage($idUsr){
        $data = $this->where('IdUsuario',$idUsr)
        ->where('TipoNotificacion','2')
        ->where('leido','0')
        ->countAllResults();
        return $data;
    }

    public function notLeida($id){
            $this->update($id,['leido' => '1']);
    }

    public function getAll($idUsr){
        //obtener todos los datos
    $data = $this->select('TiposNotificaciones.Nombre as tipo, Notificaciones.*, Usuarios.Nombre as Emisor')
                ->join('Usuarios', 'Usuarios.Id = Notificaciones.IdUsuario')
                ->join('TiposNotificaciones', 'TiposNotificaciones.Id = Notificaciones.TipoNotificacion')
                ->where('Notificaciones.deleted_at', null)
                ->where('IdUsuario', $idUsr)
                ->findAll();
    return $data;
    
    }   

}