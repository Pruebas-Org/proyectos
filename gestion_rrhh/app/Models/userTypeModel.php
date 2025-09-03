<?php

namespace App\Models;

use CodeIgniter\Model;

class userTypeModel extends Model
{
    protected $table = 'TiposUsuarios';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['Nombre'];
    protected $returnType = 'App\Entities\UserType'; // Tipo de entidad que devuelve el modelo

    public function getType(){
            //obtener todos los datos
        $data = $this->where('deleted_at', null)
                    ->findAll();
        return $data;
        
    }


}