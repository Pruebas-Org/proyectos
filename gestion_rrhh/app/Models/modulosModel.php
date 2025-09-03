<?php

namespace App\Models;

use CodeIgniter\Model;

class modulosModel extends Model
{
    protected $table = 'Modulos';
    protected $primaryKey = 'Id';
    protected $allowedFields = ['NombreItem','Ruta','TipoUsuario', 'updated_at'];
    protected $returnType = 'App\Entities\modulos'; // Tipo de entidad que devuelve el modelo

    public function getModulos($idUsr){
        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT 
                m.NombreItem,
                m.Ruta
            FROM 
                Usuarios u
            JOIN 
                Modulos m
            ON 
                JSON_CONTAINS(CAST(m.TipoUsuario AS JSON), CAST(u.TipoUsuario AS JSON), '$')
            WHERE 
                u.Id = ?
        ", [$idUsr]);

        $result = $query->getResult();

        return $result;

    }

    public function getAllModulos(){
        $allModules = $this->where('deleted_at', null)
                            ->findAll();
        
        return $allModules;
    }

    public function getAllModulosForType($idModule){
        $db = \Config\Database::connect();

        $query = $db->query("
            SELECT
                *
            FROM 
                Modulos
            WHERE JSON_CONTAINS(TipoUsuario, ?);
        ", [$idModule]);

        $result = $query->getResult();

        return $result;
    }

    public function updateTipoUsuario($moduloId, $tipoUsr) {
        // Obtener el módulo actual
        $modulo = $this->find($moduloId);
        $fechaUpdate = date('Y-m-d H:i:s');
        //log_message('info', 'fecha: ' . $fechaUpdate);
        if ($modulo) {
            // Decodificar el campo TipoUsuario si es una cadena JSON
            $tipoUsuarios = json_decode($modulo->TipoUsuario, true);
    
            if (!is_array($tipoUsuarios)) {
                $tipoUsuarios = [];
            }
    
            // Convertir todos los elementos a enteros
            $tipoUsuarios = array_map('intval', $tipoUsuarios);
            //log_message('info', 'Tipo de Usr en DB: ' . $modulo->TipoUsuario);
    
            // Agregar el nuevo tipo de usuario si no existe en el array
            if (!in_array($tipoUsr, $tipoUsuarios)) {
                $tipoUsuarios[] = $tipoUsr;
            }
    
            // Codificar el array de vuelta a JSON sin comillas alrededor de los números
            $modulo->TipoUsuario = json_encode(array_unique($tipoUsuarios), JSON_NUMERIC_CHECK);
    
            // Actualizar el módulo en la base de datos
            $this->update($moduloId, ['TipoUsuario' => $modulo->TipoUsuario, 'updated_at' => $fechaUpdate]);
        }
    }

    public function removeTipoUsuario($moduloId, $tipoUsr) {
        // Obtener el módulo actual
        $modulo = $this->find($moduloId);
        $fechaUpdate = date('Y-m-d H:i:s');
        //log_message('info', 'fecha: ' . $fechaUpdate);
        if ($modulo) {
            // Decodificar el campo TipoUsuario si es una cadena JSON
            $tipoUsuarios = json_decode($modulo->TipoUsuario, true);
    
            if (!is_array($tipoUsuarios)) {
                $tipoUsuarios = [];
            }
    
            // Convertir todos los elementos a enteros y eliminar el tipo de usuario del array si existe
            $tipoUsuarios = array_map('intval', $tipoUsuarios);
    
            if (($key = array_search($tipoUsr, $tipoUsuarios)) !== false) {
                unset($tipoUsuarios[$key]);
            }
    
            // Codificar el array de vuelta a JSON sin comillas alrededor de los números
            $modulo->TipoUsuario = json_encode(array_values($tipoUsuarios), JSON_NUMERIC_CHECK);
    
            // Actualizar el módulo en la base de datos
            //actualizar tambien updated_at
            $this->update($moduloId, ['TipoUsuario' => $modulo->TipoUsuario, 'updated_at' => $fechaUpdate]);

            

        }
    }
    

    }
