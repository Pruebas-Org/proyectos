<?php

namespace App\Models;

use CodeIgniter\Model;

class userModel extends Model
{
    protected $table = 'Usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['Nombre', 'Apellido', 'Email', 'Password', 'FechaNacimiento', 'FechaIngreso','TipoUsuario','idEquipo', 'foto','Telefono','session_token'];
    protected $returnType = 'App\Entities\User'; // Tipo de entidad que devuelve el modelo

    // Función para verificar el inicio de sesión
    public function login($username)
    {
        $user = $this->where('Email', $username)
                     ->where('deleted_at', null)
                     ->first();
        return $user;
    }

    public function getData($id){
        //obtener todos los datos
        $data = $this->where('Usuarios.Id',$id)
                     ->where('Usuarios.deleted_at', null)
                     ->join('Equipo', 'Equipo.Id = Usuarios.idEquipo')
                     ->findAll();
        return $data;
    }

    public function getDataForEdit($id){
        //obtener todos los datos
        $data = $this->where('Usuarios.Id',$id)
                     ->where('Usuarios.deleted_at', null)
                     ->join('Equipo', 'Equipo.Id = Usuarios.idEquipo')
                     ->findAll();
        return $data;
    }

    //cantidad de usuarios
    public function getCountUsers(){
        $count = $this->where('deleted_at', null)
                      ->countAllResults();
        return $count;
    }
    


    public function getDataList(){
        //obtener todos los datos
        $data = $this->select('Usuarios.Id as idUsuarios, Usuarios.*, Equipo.*')
                     ->where('Usuarios.deleted_at', null)
                     ->join('Equipo', 'Equipo.Id = Usuarios.idEquipo')
                     ->findAll();
        return $data;
    }
    public function getDataOnline(){
        //obtener todos los datos
        $data = $this->select('Usuarios.Id as idUsuarios, Usuarios.*, Equipo.*,Asistencia.*')
                     ->where('Usuarios.deleted_at', null)
                     ->where('DATE(Asistencia.Fecha) = CURDATE()')
                     ->where('Asistencia.Status','en_trabajo')
                     ->join('Equipo', 'Equipo.Id = Usuarios.idEquipo')
                     ->join('Asistencia','Asistencia.IdUsuarios=Usuarios.Id')
                     ->findAll();
        return $data;
    }

    public function NewUser($data){
        helper('image'); // Cargar el helper
        foreach($data as $datos)
        {
        $nombre = $datos['nombre'];
        $apellido = $datos['apellidos'];
        $tipoEquipo = $datos['tipoEquipo'];
        $tipo = $datos['tipo'];
        $fechaNac = $datos['fechaNac'];
        $fechaIng = $datos['fechaIng'];
        $correo = $datos['correo'];
        $telefono = $datos['telefono'];
        $pass = password_hash($datos['password'],PASSWORD_DEFAULT);

        //guardar los datos y devolver el id
        $id = $this->insert([
            'Nombre' => $nombre,
            'Apellido' => $apellido,
            'Email' => $correo,
            'Password' => $pass,
            'Telefono' => $telefono,
            'FechaNacimiento' => $fechaNac,
            'FechaIngreso' => $fechaIng,
            'idEquipo' => $tipoEquipo,
            'TipoUsuario' => $tipo
            ]);

        /// Manejo de la foto
        if (isset($datos['foto']) && $datos['foto'] instanceof \CodeIgniter\Files\File) {
            $uploadedFile = $datos['foto'];
            
            if (isValidImage($uploadedFile)) {
                $newFilePath = saveImageWithCustomName($uploadedFile, $nombre, $apellido);
                // Extrae solo el nombre del archivo para guardar en la base de datos
                $newFileName = basename($newFilePath);
                
                // Actualizar el registro del usuario con el nombre de la foto
                $this->update($id, ['foto' => $newFileName]);
            }
        }
            return $id;

        }
    }

    public function setSessionToken($userId, $token)
    {
        $this->update($userId, ['session_token' => $token]);
    }

    public function clearSessionToken($userId)
    {
        $this->update($userId, ['session_token' => null]);
    }
}