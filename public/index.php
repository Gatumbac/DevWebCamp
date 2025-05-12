<?php 
require_once __DIR__ . '/../includes/app.php';

use Controllers\AttendeeController;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventAPI;
use Controllers\EventController;
use Controllers\GiftController;
use Controllers\PageController;
use Controllers\RegistrationController;
use Controllers\SpeakerAPI;
use Controllers\SpeakerController;
use MVC\Router;

$router = new Router();

//Auth
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'processLogin']);
$router->get('/logout', [AuthController::class, 'logout']);

$router->get('/crear-cuenta', [AuthController::class, 'signup']);
$router->post('/crear-cuenta', [AuthController::class, 'processSignup']);

$router->get('/olvide-password', [AuthController::class, 'forgotPassword']);
$router->post('/olvide-password', [AuthController::class, 'processForgotPassword']);

$router->get('/reestablecer-password', [AuthController::class, 'resetPassword']);
$router->post('/reestablecer-password', [AuthController::class, 'processResetPassword']);

$router->get('/revisar-correo', [AuthController::class, 'emailInstructions']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmAccount']);

//Pages
$router->get('/', [PageController::class, 'index']);
$router->get('/404', [PageController::class, 'error']);
$router->get('/devwebcamp', [PageController::class, 'event']);
$router->get('/paquetes', [PageController::class, 'packages']);
$router->get('/conferencias-workshops', [PageController::class, 'conferences']);

//User registration
$router->get('/finalizar-registro', [RegistrationController::class, 'registration']);
$router->post('/finalizar-registro/gratis', [RegistrationController::class, 'freePlan']);
$router->post('/finalizar-registro/pagar', [RegistrationController::class, 'pay']);
$router->get('/finalizar-registro/conferencias', [RegistrationController::class, 'conferences']);
$router->post('/finalizar-registro/conferencias', [RegistrationController::class, 'saveRegistration']);
$router->get('/boleto', [RegistrationController::class, 'ticket']);

//Admin Zone
$router->get('/admin/dashboard', [DashboardController::class, 'index']);
$router->get('/admin/ponentes', [SpeakerController::class, 'index']);
$router->get('/admin/ponentes/crear', [SpeakerController::class, 'create']);
$router->post('/admin/ponentes/crear', [SpeakerController::class, 'processCreation']);
$router->get('/admin/ponentes/editar', [SpeakerController::class, 'update']);
$router->post('/admin/ponentes/editar', [SpeakerController::class, 'processUpdate']);
$router->post('/admin/ponentes/eliminar', [SpeakerController::class, 'delete']);

$router->get('/admin/eventos', [EventController::class, 'index']);
$router->get('/admin/eventos/crear', [EventController::class, 'create']);
$router->post('/admin/eventos/crear', [EventController::class, 'processCreation']);
$router->get('/admin/eventos/editar', [EventController::class, 'update']);
$router->post('/admin/eventos/editar', [EventController::class, 'processUpdate']);
$router->post('/admin/eventos/eliminar', [EventController::class, 'delete']);

$router->get('/admin/registrados', [AttendeeController::class, 'index']);
$router->get('/admin/regalos', [GiftController::class, 'index']);

//API
$router->get('/api/horario-eventos', [EventAPI::class, 'index']);
$router->get('/api/ponentes', [SpeakerAPI::class, 'index']);

$router->checkRoute();

