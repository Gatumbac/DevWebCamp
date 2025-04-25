<?php
namespace Controllers;

use Classes\ImageHandler;
use MVC\Router;
use Model\Speaker;

class SpeakerController {
    public static function index(Router $router) {
        isAdmin();
        $speakers = Speaker::all();

        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            'speakers' => $speakers
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        $speaker = new Speaker();
        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker
        ]);
    }

    public static function processCreation(Router $router) {
        isAdmin();
        $_POST["networks"] = json_encode($_POST["networks"], JSON_UNESCAPED_SLASHES);
        $speaker = new Speaker($_POST);
        if ($_FILES["image"]["tmp_name"]) {
            $speaker->setImage(ImageHandler::getRandomName());
        }
        $alerts = $speaker->validate();

        if(empty($alerts)) {
            ImageHandler::processImage($_FILES["image"], $speaker->getImage(), IMAGE_FOLDER . '/speakers/');

            if($speaker->save()) {
                redirect('/admin/ponentes');
            }
        }

        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker,
            'alerts' => $alerts,
            'networks' => json_decode($speaker->getNetworks(), true)
        ]);
    }

    public static function update(Router $router) {
        isAdmin();
        $speaker = self::getSpeakerByForm($_GET);

        $router->render('admin/speakers/update', [
            'title' => 'Editar Ponente',
            'speaker' => $speaker,
            'networks' => json_decode($speaker->getNetworks(), true)
        ]);
    }

    public static function processUpdate(Router $router) {
        isAdmin();
        $speaker = self::getSpeakerByForm($_GET);
        $_POST["networks"] = json_encode($_POST["networks"], JSON_UNESCAPED_SLASHES);
        $speaker->sync($_POST);
        $alerts = $speaker->validate();

        if(empty($alerts)) {
            if ($_FILES["image"]["tmp_name"]) {
                ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.png');
                ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.webp');
                $speaker->setImage(ImageHandler::getRandomName());
                ImageHandler::processImage($_FILES["image"], $speaker->getImage(), IMAGE_FOLDER . '/speakers/');
            }
            if($speaker->save()) {
                redirect('/admin/ponentes');
            }
        }

        $router->render('admin/speakers/update', [
            'title' => 'Editar Ponente',
            'speaker' => $speaker,
            'alerts' => $alerts,
            'networks' => json_decode($speaker->getNetworks(), true)
        ]);
    }

    public static function delete() {
        isAdmin();
        $speaker = self::getSpeakerByForm($_POST);
        if($speaker->delete()) {
            ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.png');
            ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.webp');
            redirect('/admin/ponentes');
        }
    }

    public static function getSpeakerByForm($array) {
        $id = s($array['id'] ?? '');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        verify($id, '/admin/ponentes');

        $speaker = Speaker::find($id);
        verify($speaker, '/admin/ponentes');
        return $speaker;
    }
}