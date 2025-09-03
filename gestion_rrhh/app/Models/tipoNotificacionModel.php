<?php

namespace App\Models;

use CodeIgniter\Model;

class tipoNotificacionModel extends Model
{
    protected $table = 'TiposNotificaciones';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['Nombre'];
    protected $returnType = 'App\Entities\tipoNotificacion'; // Tipo de entidad que devuelve el modelo

    public function getTypeNotification(){
            //obtener todos los datos
        $data = $this->where('deleted_at', null)
                    ->findAll();
        return $data;
        
    }


}