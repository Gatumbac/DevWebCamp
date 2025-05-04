<?php
namespace Controllers;

use Classes\FlashMessage;
use Model\Category;
use Model\Speaker;
use Model\Day;
use Model\Hour;
use Model\Event;
use MVC\Router;

class EventController {
    public static function index(Router $router) {
        isAdmin();
        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops'
        ]);
    }

    public static function create(Router $router) {
        isAdmin();
        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();
        $event = new Event();

        $router->render('admin/events/create', [
            'title' => 'Registrar Evento',
            'categories' => $categories, 
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function processCreation(Router $router) {
        isAdmin();
        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();

        $event = new Event($_POST);
        $alerts = $event->validate();

        if(empty($alerts)) {
            $result = $event->save();
            if($result['result']) {
                FlashMessage::setSuccess();
            } else {
                FlashMessage::setError();
            }
            redirect('/admin/eventos');
        }

        $router->render('admin/events/create', [
            'title' => 'Registrar Evento',
            'categories' => $categories, 
            'days' => $days,
            'hours' => $hours,
            'alerts' => $alerts,
            'event' => $event,
            'view_scripts' => []
        ]);
    }
}