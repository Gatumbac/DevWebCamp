<?php
namespace Controllers;
use MVC\Router;
use Model\User;

class SpeakerController {
    public static function index(Router $router) {
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas'
        ]);
    }

    public static function create(Router $router) {
        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => new User()
        ]);
    }
}