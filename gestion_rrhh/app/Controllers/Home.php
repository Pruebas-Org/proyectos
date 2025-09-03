<?php

namespace App\Controllers;

use App\Models\userModel;
use App\Models\userSchedulModel;
use App\Models\asistenciaModel;
use App\Models\modulosModel;
use App\Models\tipoNotificacionModel;
use App\Models\notificacionesModel;

class Home extends BaseController
{
    private $userModel;
    private $userSchedulModel;
    private $asistenciaModel;
    private $modulosModel;
    private $tipoNotificacionModel;
    private $notificacionesModel;
    private $user_Id;
    private $sessionToken;

    public function __construct()
    {
        $this->userModel = new userModel();
        $this->userSchedulModel = new userSchedulModel();
        $this->asistenciaModel = new asistenciaModel();
        $this->modulosModel = new modulosModel();
        $this->tipoNotificacionModel = new tipoNotificacionModel();
        $this->notificacionesModel = new notificacionesModel();
        $session = session();
        $this->userId = $session->get('user_id');
        $this->sessionToken = $session->get('session_token');
        helper('custom'); // Cargar el helper personalizado
    }

    public function index()
    {
        $allData = $this->userModel->getData($this->userId);
        $horaDia = $this->getSchedulDay();
        $modulos = $this->modulosModel->getModulos($this->userId);
        $countNoti = $this->notificacionesModel->countNoti($this->userId);
        $countMens = $this->notificacionesModel->countMessage($this->userId);
        $notificaciones = $this->notificacionesModel->getNotifications($this->userId);
        $mensajes = $this->notificacionesModel->getMessage($this->userId);
        $userCount = $this->userModel->getCountUsers();
        $working = $this->asistenciaModel->getWorkingUser();
        $holiday = $this->asistenciaModel->getholidaysUser();
    
        // Inicializar arrays para separar los módulos
        $modulosComunicacion = [];
        $modulosUsuario = [];

        // Separar los módulos
        foreach ($modulos as $modulo) {
            if (in_array($modulo->NombreItem, ['Notificación', 'Mensaje'])) {
                $modulosComunicacion[] = $modulo;
            } else {
                $modulosUsuario[] = $modulo;
            }
        }


        $data = [
            'allData' => $allData,
            'user_Id' => $this->userId,
            'horaDia' => $horaDia,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens,
            'notificaciones' =>$notificaciones,
            'mensajes' =>$mensajes,
            'userCount' =>$userCount,
            'working' =>$working,
            'holiday' =>$holiday,
            'section' => 'dashboard', // Para identificar la sección actual
        ];
        echo view('template/header',$data);
        echo view('dashboard/index',$data);
        echo view('template/footer');
    }

    public function getSchedulDay()
{
    $horarios = $this->userSchedulModel->getScheduleDifference($this->userId);

    // Definir el array de días de la semana con índices del 0 al 6
    $diasSemana = [
        0 => 'Dom', // Domingo
        1 => 'Lun', // Lunes
        2 => 'Mar', // Martes
        3 => 'Mié', // Miércoles
        4 => 'Jue', // Jueves
        5 => 'Vie', // Viernes
        6 => 'Sab'  // Sábado
    ];

    // Obtener el día actual en formato abreviado
    $diaIndice = date('w'); // 'w' devuelve el día de la semana (0-6)

    // Validar el índice antes de usarlo
    if (array_key_exists($diaIndice, $diasSemana)) {
        $diaActual = $diasSemana[$diaIndice]; // Día actual en formato abreviado
    } else {
        return []; // Retorna un array vacío si el índice es inválido
    }

    // Inicializar un array para almacenar la diferencia de tiempo
    $result = [];

    // Recorrer el array de horarios y comparar con el día actual
    foreach ($horarios as $horario) {
        // Decodificar el campo dias de JSON a un array PHP
        $diasArray = json_decode($horario->dias, true); // true para obtener array asociativo

        // Verificar si $diasArray es un array
        if (is_array($diasArray)) {
            // Verificar si el día actual está en el array de días de cada objeto
            if (in_array($diaActual, $diasArray)) {
                // Almacenar la diferencia de tiempo y otros datos
                $result[] = [
                    'HoraInicio' => $horario->HoraInicio,
                    'HoraFinal' => $horario->HoraFinal,
                    'Diferencia' => $horario->Diferencia,
                    'IdUsuarios' => $horario->IdUsuarios,
                    'Dias' => implode(', ', $diasArray)
                ];
                //si $horario->Diferencia no existe o es null devolver 00:00:00
                }
        }
    }

    return $result; // Retorna el array con las diferencias de tiempo y otros datos


    }

    public function añadirAsistencia(){
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $usuario = $this->userId;
        $sessionToken = $this->sessionToken;

        $asistencia = $this->asistenciaModel->nuevaAsistencia($usuario, $fecha,$hora, $sessionToken);

        if($asistencia){
        //guardar $asistencia en una session como idasistencia
        $session = session();
                $session->set([
                    'IdAsistencia' => $asistencia
                ]);
                return 'Guardado';
        }else{
            return 'Error';
        }
    }
    public function finalizarAsistencia(){
        $session = session();
        $asistencia = $session->get('IdAsistencia');
        $sessionToken = $this->sessionToken;
        $fecha = date('Y-m-d');
        $horaFin = date('H:i:s');
        $usuario = $this->userId;
        $horasTrab = $this->request->getPost('horTrab');

        $finAsistencia = $this->asistenciaModel->finalizarAsistencia($asistencia, $fecha,$horaFin, $horasTrab,$sessionToken);
        if($finAsistencia =='ok'){
            $session->remove('idasistencia');
        }
    }


    public function workHours(){
        $usuario = $this->userId;
        $fecha = date('Y-m-d');
        $sessionToken = $this->sessionToken;

        $horaInicial = $this->asistenciaModel->starHour($usuario, $fecha,$sessionToken);

        if($horaInicial === null){
            $horaInicial = '00:00:00';
        }else{
            return $horaInicial->HorarioInicial;
        }

        

        $usuario = $this->userId;
    }

    

    
}
