<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\userModel;
use App\Models\userTypeModel;
use App\Models\userTeamModel;
use App\Models\userSchedulModel;
use App\Models\userHorariosModel;
use App\Models\asistenciaModel;
use App\Models\modulosModel;
use App\Models\tipoNotificacionModel;
use App\Models\notificacionesModel;
use App\Controllers\Home;
use App\Entities\User;

class comunicacionesController extends BaseController
{
    protected $userModel;
    protected $typeModel;
    protected $teamModel;
    protected $schedulModel;
    protected $horariosModel;
    private $asistenciaModel;
    private $modulosModel;
    private $tipoNotificacionModel;
    private $notificacionesModel;
    private $home;
    private $userId;
    private $sessionToken;
public function __construct()
    {

        $session = session();
        $this->userModel = new userModel();
        $this->typeModel = new userTypeModel();
        $this->teamModel = new userTeamModel();
        $this->schedulModel = new userSchedulModel();
        $this->horariosModel = new userHorariosModel();
        $this->asistenciaModel = new asistenciaModel();
        $this->modulosModel = new modulosModel();
        $this->tipoNotificacionModel = new tipoNotificacionModel();
        $this->notificacionesModel = new notificacionesModel();
        $this->home = new Home();
        $this->userId = $session->get('user_id');
        $this->sessionToken = $session->get('session_token');

        helper('custom'); // Cargar el helper personalizado

    }

public function notificaciones()
    {

        $allData = $this->userModel->getData($this->userId);
        $horaDia = $this->home->getSchedulDay();
        $modulos = $this->modulosModel->getModulos($this->userId);
        $allModules = $this->modulosModel->getAllModulos();
        $allTypes = $this->typeModel->getType();
        $typeNot = $this->tipoNotificacionModel->getTypeNotification();
        $countNoti = $this->notificacionesModel->countNoti($this->userId);
        $countMens = $this->notificacionesModel->countMessage($this->userId);
        $allNotiMes= $this->notificacionesModel->getAll($this->userId);
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
            'allModules' => $allModules,
            'allTypes' => $allTypes,
            'typeNot' =>$typeNot,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens,
            'allNotiMes' =>$allNotiMes,
        ];

        
        echo view('template/header',$data);
        echo view('comunicaciones/notificaciones',$data);
        echo view('template/footer');
    }


    public function mensajes()
    {

        $allData = $this->userModel->getData($this->userId);
        $horaDia = $this->home->getSchedulDay();
        $modulos = $this->modulosModel->getModulos($this->userId);
        $allModules = $this->modulosModel->getAllModulos();
        $allTypes = $this->typeModel->getType();
        $typeNot = $this->tipoNotificacionModel->getTypeNotification();
        $countNoti = $this->notificacionesModel->countNoti($this->userId);
        $countMens = $this->notificacionesModel->countMessage($this->userId);
        
        

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
            'allModules' => $allModules,
            'allTypes' => $allTypes,
            'typeNot' =>$typeNot,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens,
        ];

        
        echo view('template/header',$data);
        echo view('comunicaciones/mensajes',$data);
        echo view('template/footer');
    }

    public function getAllUsr()
    {
        $allUsr = $this->userModel->getDataList();

        if ($allUsr) {
            $options = '<option value="">Seleccione un Usuario</option>';
            //agregar una opcion q sea Todos
            $options .= '<option value="0">Todos</option>';
            foreach ($allUsr as $usr) {
                $options .= '<option value="' . $usr->idUsuarios . '">' . $usr->Nombre . $usr->Apellido .'</option>';
            }
            echo $options;
        } else {
            echo '<option value="">Seleccione un Usuario</option>';
        }
    }

    public function getAllNotification() {
        $notificaciones = $this->notificacionesModel->getNotifications($this->userId);
        $noti = '';  // Inicializa la variable antes del bucle
    
        if ($notificaciones) {
            foreach ($notificaciones as $not) {
                $noti .= '<a class="dropdown-item d-flex align-items-center" onclick="loadDetails(1, ' . $not->Id . ')">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500" id="diaHoraNot-' . $not->Id . '">' . $not->created_at . '</div>
                                <span class="font-weight-bold" id="contenidoNot-' . $not->Id . '">' . $not->contenido . '</span>
                            </div>
                          </a>';
            }
        } else {
            $noti .= '<a class="dropdown-item text-center">No new notifications</a>';
        }
        echo $noti;
    }

    public function getAllMessage() {
        $mensajes = $this->notificacionesModel->getMessage($this->userId);
        $mens = '';  // Inicializa la variable antes del bucle
    
        if ($mensajes) {
            foreach ($mensajes as $mess) {
                $mens .= '<a class="dropdown-item d-flex align-items-center" onclick="loadDetails(2, ' . $mess->Id . ')">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500" id="diaHoraMes-' . $mess->Id . '">' . $mess->created_at . '</div>
                                <span class="font-weight-bold" id="contenidoMes-' . $mess->Id . '">' . $mess->contenido . '</span>
                            </div>
                          </a>';
            }
        } else {
            $mens .= '<a class="dropdown-item text-center">No new Messages</a>';
        }
        echo $mens;
    }

    public function checkNewNotifications() {
        $countNoti = $this->notificacionesModel->countNoti($this->userId);
        $countMens = $this->notificacionesModel->countMessage($this->userId);
        $mensajes = $this->notificacionesModel->getNewMessage($this->userId);
        $notificaciones = $this->notificacionesModel->getNewNotifications($this->userId);
    
        $response = [
            'new_notifications' => $countNoti > 0,
            'notification_count' => $countNoti,
            'new_messages' => $countMens > 0,
            'message_count' => $countMens,
            'id_user' => $this->userId,
            'new_notifications_ids' => array_column($notificaciones, 'Id'),
            'new_messages_ids' => array_column($mensajes, 'Id')

        ];

        echo json_encode($response);
        exit();
    }
    
    

    public function sendNotificacion(){
        $mensaje = $this->request->getPost('mensaje');
        $usuario = $this->request->getPost('usr');
        $tipoNotificacion = $this->request->getPost('tiponoti');

        

        //si usuario es 0 mandar a todos los usuarios 
        if($usuario == 0 && $tipoNotificacion == 1){

            $allUsr = $this->userModel->getDataList();
            foreach ($allUsr as $usr) {
                log_message('info', 'Usuario: '. $usr->idUsuarios . ' ' . 'Esto corresponde solo Notificación' );
                $this->notificacionesModel->sendNotificacionToUser($usr->idUsuarios,$mensaje,$tipoNotificacion);
            }
        }else if($tipoNotificacion == 1 && $usuario != 0){
            $this->notificacionesModel->sendNotificacionToUser($usuario,$mensaje,$tipoNotificacion);
            log_message('info', 'Usuario: '. $usuario . ' ' . 'Esto corresponde solo Notificación');
        }
        //si tipoNotificacion es 2 tambien mandar un mail al usuario o los usuarios ademas del mensaje interno del sistema
        if($tipoNotificacion == 2 && $usuario == 0){
            $allUsr = $this->userModel->getDataList();
            foreach ($allUsr as $usr) {
                log_message('info', 'Usuario: '. $usr->idUsuarios . ' ' . 'Esto corresponde solo Mensaje interno y mail' );
                $this->notificacionesModel->sendNotificacionToUser($usr->idUsuarios,$mensaje,$tipoNotificacion);
                //$this->sendMailToUser($usr->idUsuarios,$mensaje);
            }
        }else if($tipoNotificacion == 2 && $usuario != 0){
            log_message('info', 'Usuario: '. $usuario . ' ' . 'Esto corresponde solo Mensaje interno y mail' );
            $this->notificacionesModel->sendNotificacionToUser($usuario,$mensaje,$tipoNotificacion);
                //$this->sendMailToUser($usuario,$mensaje);
            }

    }

    public function leida($id){
        log_message('info', $id);
        $this->notificacionesModel->notLeida($id);
    }

    public function getMessageCount()
    {
    $countMens = $this->notificacionesModel->countMessage($this->userId);

    echo json_encode($countMens);
    }

    public function getNotCount()
    {
    $countNot = $this->notificacionesModel->countNoti($this->userId);

    echo json_encode($countNot);
    }
}