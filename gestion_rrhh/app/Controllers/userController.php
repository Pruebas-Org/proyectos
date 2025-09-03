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
use App\Models\notificacionesModel;
use App\Controllers\Home;
use App\Entities\User;

class userController extends BaseController
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
        
        // Inicializar arrays para separar los módulos
        $modulosComunicacion = [];
        $modulosUsuario = [];

        helper('custom'); // Cargar el helper personalizado
    }
    public function index()
    {
       
        return view('user/login');
    }

    public function login()
    {
        $session = session();
        // Procesar el formulario de inicio de sesión
        $data = [];
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Realizar la autenticación
            $user = $this->userModel->login($username);
            $sessionToken = $this->sessionToken;
            if ($user && password_verify($password, $user->Password)) {
                // Iniciar sesión

                if (!$user->session_token) {
                    $sessionToken = generateSessionToken();
                    $session->set([
                        'logged_in' => true,
                        'user_id' => $user->Id,
                        'session_token' => $sessionToken
                    ]);
                    $this->userModel->setSessionToken($user->Id, $sessionToken);
                }else{
                    $session->set([
                        'logged_in' => true,
                        'user_id' => $user->Id,
                        'session_token' => $user->session_token
                        // Otros datos que quieras almacenar en la sesión
                    ]);
                }
                // Redirigir a la página de inicio después del inicio de sesión exitoso
                return redirect()->to('/dashboard');
            } else {
                $data['error'] = 'Usuario o contraseña incorrectos.';
                return view('user/login', $data);
            }
        }
        
    }

    public function logout()
    {
        $session = session();
        $sessionToken = $this->sessionToken;
        
        $activo = $this->asistenciaModel->verfAsAct($sessionToken);


        if($activo == 'ok'){
            // Cerrar sesión
            $this->userModel->clearSessionToken($this->userId);
            $session = session();
            $session->destroy();
            session()->remove('user_id');
            session()->remove('session_token');
            $session->set([
                'logged_in' => false,
            ]);
            // Redirigir a la página de inicio de sesión después del cierre de sesión
            return redirect()->to('/');
        }else{
            // Cerrar sesión
            
            $session = session();
            $session->destroy();
            session()->remove('user_id');
            $session->set([
                'logged_in' => false,
            ]);
            // Redirigir a la página de inicio de sesión después del cierre de sesión
            return redirect()->to('/');
        }
        
    }

    public function personalProfile($id = 0){
        
        $allData = $this->userModel->getData($this->userId); 
        $forEdit = $this->userModel->getDataForEdit($id);
        $modulos = $this->modulosModel->getModulos($this->userId);
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
        $horaDia = $this->home->getSchedulDay();
        // Convertir la fecha en cada registro
        foreach ($allData as $data) {
            $data->FechaNacimiento = convertDateToYMD($data->FechaNacimiento);
        }
        $data = [
            'allData' => $allData,
            'forEdit' => $forEdit,
            'user_Id' => $this->userId,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'horaDia' => $horaDia,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens
        ];
        echo view('template/header',$data);
        echo view('user/profile',$data);
        echo view('template/footer');
    }

    public function userList(){
        //dd($this->userId);
        $dataProfile = $this->userModel->getDataList();
        $countNoti = $this->notificacionesModel->countNoti($this->userId);
        $countMens = $this->notificacionesModel->countMessage($this->userId);
        $allData = $this->userModel->getData($this->userId);
        $modulos = $this->modulosModel->getModulos($this->userId);
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
        $horaDia = $this->home->getSchedulDay();
        // Convertir la fecha en cada registro
        foreach ($allData as $data) {
            $data->FechaNacimiento = convertDateToYMD($data->FechaNacimiento);
        }

        $data = [
            'allData' => $allData,
            'dataProfile' => $dataProfile,
            'user_Id' => $this->userId,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'horaDia' => $horaDia,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens
        ];
        //dd($data);
        echo view('template/header',$data);
        echo view('user/userList',$data);
        echo view('template/footer');
    }


    public function userOnline(){
        $allDataOnline = $this->userModel->getDataOnline();
        $dataProfile = $this->userModel->getData($this->userId);
        $modulos = $this->modulosModel->getModulos($this->userId);
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
        $horaDia = $this->home->getSchedulDay();
        // Convertir la fecha en cada registro
        foreach ($allDataOnline as $data) {
            $data->FechaNacimiento = convertDateToYMD($data->FechaNacimiento);
        }

        $data = [
            'dataProfile' => $allDataOnline,
            'allData' => $dataProfile,
            'user_Id' => $this->userId,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'horaDia' => $horaDia,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens
        ];
        //dd($data);
        echo view('template/header',$data);
        echo view('user/userOnline',$data);
        echo view('template/footer');
    }

    public function userRegister(){
        
        $userType = $this->typeModel->getType();
        $team = $this->teamModel->getTeam();
        $userSchedul = $this->schedulModel->getSchedules();
        $allData = $this->userModel->getData($this->userId); 
        $modulos = $this->modulosModel->getModulos($this->userId);
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
        $horaDia = $this->home->getSchedulDay();
        $data = [
            'allData' => $allData,
            'user_Id' => $this->userId,
            'userType' => $userType,
            'team' => $team,
            'horarios' => $userSchedul,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'horaDia' => $horaDia,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens
        ];
        echo view('template/header',$data);
        echo view('user/register',$data);
        echo view('template/footer');
    }

    public function asistenciaUser(){
        
        $userType = $this->typeModel->getType();
        $team = $this->teamModel->getTeam();
        $userSchedul = $this->schedulModel->getSchedules();
        $allData = $this->userModel->getData($this->userId); 
        $modulos = $this->modulosModel->getModulos($this->userId);
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
        $horaDia = $this->home->getSchedulDay();
        
        $data = [
            'allData' => $allData,
            'user_Id' => $this->userId,
            'userType' => $userType,
            'team' => $team,
            'horarios' => $userSchedul,
            'modulosComunicacion' => $modulosComunicacion,
            'modulosUsuario' => $modulosUsuario,
            'horaDia' => $horaDia,
            'countNoti' =>$countNoti,
            'countMens' =>$countMens,
            'section' => 'asistenciaUser'
        ];
        echo view('template/header',$data);
        echo view('user/asistencia',$data);
        echo view('template/footer');
    }

    


    public function newUser(){
        $datos = [
            [
                'nombre' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellidos'),
                'tipoEquipo' => $this->request->getPost('tipoEquipo'),
                'tipo' => $this->request->getPost('tipo'),
                'fechaNac' => $this->request->getPost('fechaNac'),
                'fechaIng' => $this->request->getPost('fechaIng'),
                'correo' => $this->request->getPost('correo'),
                'telefono' => $this->request->getPost('telefono'),
                'password' => $this->request->getPost('password'),
                'password2' => $this->request->getPost('password2'),
                'foto' => $this->request->getFile('foto') // Obtén el archivo
            ]
        ];

        $horarios = json_decode($this->request->getPost('horarios'), true);

        // Manejar el registro del usuario
        $newUser = $this->userModel->NewUser($datos);
        if ($newUser) {
            // Manejar los horarios del usuario
            $this->horariosModel->newUserHorarios($horarios, $newUser);
        }

    }

    public function asistenciaUserAll(){
        $usuario = $this->userId;


        $asistenciaData = $this->asistenciaModel->getAsistenciaById($usuario);

       $events = [];
        foreach ($asistenciaData as $registro) {
            // Accede a las propiedades directamente desde el objeto Entity
            $fecha = $registro->Fecha;
            $horarioInicial = $registro->HorarioInicial;
            $horarioFinal = $registro->HorarioFinal;

            // Puedes hacer un var_dump aquí para verificar que los estás extrayendo bien
            // var_dump($fecha, $horarioInicial, $horarioFinal);

            // Formatea los datos para FullCalendar
            $events[] = [
                'title' => 'Asistencia', // Puedes poner un título fijo o algo más descriptivo
                'start' => $fecha . 'T' . $horarioInicial,
                'end'   => $fecha . 'T' . $horarioFinal,
                // Puedes añadir más propiedades de FullCalendar si las necesitas
                'description' => 'Horas trabajadas', // Ejemplo
                'color' => '#46df2b' // O el color que desees
            ];
        }

        // Ahora, $events debería ser un array en el formato que FullCalendar espera.
        // Debes convertir este array a JSON y pasarlo a tu vista.
        echo json_encode($events);
    }



}
