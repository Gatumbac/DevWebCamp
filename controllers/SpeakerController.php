<?php
namespace Controllers;

use Classes\ImageHandler;
use MVC\Router;
use Model\Speaker;

class SpeakerController {
    public static function index(Router $router) {
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas'
        ]);
    }

    public static function create(Router $router) {
        $speaker = new Speaker();
        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker
        ]);
    }

    public static function processCreation(Router $router) {
        $speaker = new Speaker($_POST);
        if ($_FILES["image"]["tmp_name"]) {
            $speaker->setImage(ImageHandler::getRandomName());
        }
        debug($speaker);
        $alerts = $speaker->validate();

        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker,
            'alerts' => $alerts
        ]);
    }
}