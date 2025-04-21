<?php
namespace Controllers;
use MVC\Router;

class AttendeeController {
    public static function index(Router $router) {
        $router->render('admin/attendees/index', [
            'title' => 'Usuarios Registrados'
        ]);
    }
}