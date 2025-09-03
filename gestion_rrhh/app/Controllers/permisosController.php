<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\userModel;
use App\Models\userTypeModel;
use App\Models\userTeamModel;
use App\Models\userSchedulModel;
use App\Models\userHorariosModel;
use App\Models\asistenciaModel;
use App\Models\notificacionesModel;
use App\Models\modulosModel;
use App\Controllers\Home;
use App\Entities\User;

class permisosController extends BaseController
{

    protected $userModel;
    protected $typeModel;
    protected $teamModel;
    protected $schedulModel;
    protected $horariosModel;
    private $asistenciaModel;
    private $modulosModel;
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
        $this->notificacionesModel = new notificacionesModel();
        $this->home = new Home();
        $this->userId = $session->get('user_id');
        $this->sessionToken = $session->get('session_token');

        helper('custom'); // Cargar el helper personalizado
    }

    public function index()
    {
        $allData = $this->userModel->getData($this->userId);
        $horaDia = $this->home->getSchedulDay();
        $modulos = $this->modulosModel->getModulos($this->userId);
        $allModules = $this->modulosModel->getAllModulos();
        $allTypes = $this->typeModel->getType();
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
            'countNoti' =>$countNoti,
            'countMens' =>$countMens
        ];

        echo view('template/header',$data);
        echo view('modulos/permisos',$data);
        echo view('template/footer');
    }

    public function getPermisos(){
        $data = $this->request->getPost('tipo');

        $allmodfortyp = $this->modulosModel->getAllModulosForType($data);
        // Devolver los módulos como JSON
        return $this->response->setJSON($allmodfortyp);
    }

    public function updatePermisos(){
        $modulos = $this->request->getPost('moduloIds');
        $tipoUsr = $this->request->getPost('tipoId');
        
        // Obtener los módulos existentes en la base de datos para el tipo de usuario
        $usrExist = $this->modulosModel->getAllModulosForType($tipoUsr);

        //log_message('debug', 'moduloIds: ' . print_r($modulos, true));
        //log_message('debug', 'tipoId: ' . $tipoUsr);
        //log_message('debug', 'usrExist: ' . print_r($usrExist, true));

        // Extraer solo los IDs de los módulos existentes
        $usrExistIds = array_map(function($modulo) {
            return $modulo->Id;
        }, $usrExist);

        // Log para depuración de los IDs existentes
        //log_message('debug', 'usrExistIds: ' . print_r($usrExistIds, true));

        // Filtrar los módulos para obtener solo los que no están en la base de datos
        $modulosNoExistentes = array_filter($modulos, function($moduloId) use ($usrExistIds) {
            return !in_array($moduloId, $usrExistIds);
        });

        // Filtrar los módulos para obtener solo los que no están en los datos POST
        $modulosParaEliminar = array_filter($usrExistIds, function($moduloId) use ($modulos) {
            return !in_array($moduloId, $modulos);
        });
        //log_message('debug', 'modulosParaEliminar: ' . print_r($modulosParaEliminar, true));

        // Log para depuración de los módulos no existentes
        //log_message('debug', 'modulosNoExistentes: ' . print_r($modulosNoExistentes, true));

        // Actualizar los módulos que no existen en la base de datos para el tipo de usuario
        foreach ($modulosNoExistentes as $moduloId) {
            $this->modulosModel->updateTipoUsuario($moduloId, $tipoUsr);
        }
        // Eliminar el tipo de usuario de los módulos que ya no están en los datos POST
        foreach ($modulosParaEliminar as $moduloId) {
            $this->modulosModel->removeTipoUsuario($moduloId, $tipoUsr);
        }

    
    }
}