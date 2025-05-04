<?php
namespace Controllers;

use Classes\ImageHandler;
use Classes\Paginator;
use Classes\FlashMessage;
use MVC\Router;
use Model\Speaker;

class SpeakerController {
    public static function index(Router $router) {
        isAdmin();

        $currentPage = $_GET['page'] ?? '';
        $currentPage = filter_var($currentPage, FILTER_VALIDATE_INT);
        if (!$currentPage || $currentPage < 1) {
            redirect('/admin/ponentes?page=1');
        }

        $recordsPerPage = 5;
        $totalRecords = Speaker::total();

        $paginator = new Paginator($currentPage, $recordsPerPage, $totalRecords);
        if ($currentPage > $paginator->getTotalPages()) {
            redirect('/admin/ponentes?page=1');
        }

        $speakers = Speaker::paginate($recordsPerPage, $paginator->getOffset());

        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            'speakers' => $speakers,
            'pagination' => $paginator->pagination()
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        $speaker = new Speaker();
        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker,
            'view_scripts' => []
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

            $result = $speaker->save();
            if($result['result']) {
                FlashMessage::setSuccess();
            } else {
                FlashMessage::setError();
            }
            redirect('/admin/ponentes');
        }

        $router->render('admin/speakers/create', [
            'title' => 'Registrar Ponente',
            'speaker' => $speaker,
            'alerts' => $alerts,
            'networks' => json_decode($speaker->getNetworks(), true),
            'view_scripts' => []
        ]);
    }

    public static function update(Router $router) {
        isAdmin();
        $speaker = self::getSpeakerByForm($_GET);

        $router->render('admin/speakers/update', [
            'title' => 'Editar Ponente',
            'speaker' => $speaker,
            'networks' => json_decode($speaker->getNetworks(), true),
            'view_scripts' => []
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
            $result = $speaker->save();
            if($result['result']) {
                FlashMessage::setSuccess();
            } else {
                FlashMessage::setError();
            }
            redirect('/admin/ponentes');
        }

        $router->render('admin/speakers/update', [
            'title' => 'Editar Ponente',
            'speaker' => $speaker,
            'alerts' => $alerts,
            'networks' => json_decode($speaker->getNetworks(), true),
            'view_scripts' => []
        ]);
    }

    public static function delete() {
        isAdmin();
        $speaker = self::getSpeakerByForm($_POST);
        $result = $speaker->delete();
        if($result['result']) {
            ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.png');
            ImageHandler::deleteImage(IMAGE_FOLDER . '/speakers/' . $speaker->getImage() . '.webp');
            FlashMessage::setSuccess();
        } else {
            FlashMessage::setDependencyError();
        }
        redirect('/admin/ponentes');
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