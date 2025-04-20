<?php 
require_once __DIR__ . '/../includes/app.php';

use Controllers\AuthController;
use MVC\Router;

$router = new Router();

//Public Zone
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

$router->checkRoute();

