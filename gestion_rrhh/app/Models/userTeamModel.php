<?php

namespace App\Models;

use CodeIgniter\Model;

class userTeamModel extends Model
{
    protected $table = 'Equipo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['NombreEquipo'];
    protected $returnType = 'App\Entities\Team'; // Tipo de entidad que devuelve el modelo

    public function getTeam(){
        //obtener todos los datos
    $data = $this->where('deleted_at', null)
                ->findAll();
    return $data;
    
}
}