<?php
namespace Controllers;
use MVC\Router;

class EventController {
    public static function index(Router $router) {
        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
        ]);
    }
}