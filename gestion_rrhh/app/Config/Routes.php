<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('userController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'userController::index');
//$routes->match(['get', 'post'], '/', 'userController::index');
$routes->get('/', 'userController::index', ['filter' => 'Noauth:dual,noreturn']);
$routes->post('login', 'userController::login');
$routes->match(['get', 'post'],'profile/(:num)', 'userController::personalProfile/$1');
$routes->match(['get', 'post'],'logout', 'userController::logout');
$routes->get('/list', 'userController::userList');
$routes->get('/online', 'userController::userOnline');
$routes->get('/register', 'userController::userRegister');
$routes->post('/nuevoUser', 'userController::newUser');
$routes->get('/asistencia', 'userController::asistenciaUser');
$routes->post('/asistenciaUserAll', 'userController::asistenciaUserAll');

$routes->get('/dashboard', 'Home::index',['filter' => 'AuthFilter']); // Ejemplo de ruta para el dashboard
$routes->post('/nuevaAsis', 'Home::añadirAsistencia');
$routes->post('/finAsis', 'Home::finalizarAsistencia');
$routes->post('/workHours', 'Home::workHours');


$routes->get('/permisos', 'permisosController::index');
$routes->post('/getPermisos', 'permisosController::getPermisos');
$routes->post('/updatePermisos', 'permisosController::updatePermisos');

$routes->get('/notificacion', 'comunicacionesController::notificaciones');
$routes->get('/mensaje', 'comunicacionesController::mensajes');
$routes->post('/allusr', 'comunicacionesController::getAllUsr');
$routes->post('/sendNoti', 'comunicacionesController::sendNotificacion');
$routes->post('/marcarLeida/(:num)', 'comunicacionesController::leida/$1');
$routes->get('/getMessageCount', 'comunicacionesController::getMessageCount');
$routes->get('/getNotCount', 'comunicacionesController::getNotCount');
$routes->post('/getNot', 'comunicacionesController::getAllNotification');
$routes->post('/getAllMessage', 'comunicacionesController::getAllMessage');
$routes->get('/newNoti', 'comunicacionesController::checkNewNotifications');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
