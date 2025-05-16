<?php
namespace Controllers;
use MVC\Router;

class GiftController {
    public static function index(Router $router) {
        $router->render('admin/gifts/index', [
            'title' => 'Regalos',
            'view_scripts' => []
        ]);
    }
}