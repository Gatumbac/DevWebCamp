<?php

namespace Controllers;

use Model\AdminEvent;
use Model\Event;
use Model\Speaker;
use MVC\Router;

class PageController {
    public static function index(Router $router) {
        $formatedEvents = self::getFormatedEvents();
        $totalSpeakers = Speaker::total();
        $totalConferences = Event::total('category_id', 1);
        $totalWorkshops = Event::total('category_id', 2);
        $speakers = Speaker::all();

        $router->render('pages/index', [
            'title' => 'Inicio',
            'events' => $formatedEvents,
            'view_scripts' => [],
            'totalSpeakers' => $totalSpeakers,
            'totalConferences' => $totalConferences,
            'totalWorkshops' => $totalWorkshops,
            'speakers' => $speakers
        ]);
    }

    public static function event(Router $router) {
        $router->render('pages/devwebcamp', [
            'title' => 'Sobre DevWebCamp'
        ]);
    }

    public static function packages(Router $router) {
        $router->render('pages/packages', [
            'title' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferences(Router $router) {
        $formatedEvents = self::getFormatedEvents();

        $router->render('pages/conferences', [
            'title' => 'Conferencias & Workshops',
            'events' => $formatedEvents,
            'view_scripts' => []
        ]);
    }

    public static function getFormatedEvents() {
        $events = AdminEvent::orderSQL(AdminEvent::getSQL(), 'hour_id', 'ASC');
        $formatedEvents = [];

        foreach($events as $event) {
            if($event->getDayId() === '1' && $event->getCategoryId() === '1') {
                $formatedEvents['conferences_1'][] = $event;
            }

            if($event->getDayId() === '2' && $event->getCategoryId() === '1') {
                $formatedEvents['conferences_2'][] = $event;
            }

            if($event->getDayId() === '1' && $event->getCategoryId() === '2') {
                $formatedEvents['workshops_1'][] = $event;
            }

            if($event->getDayId() === '2' && $event->getCategoryId() === '2') {
                $formatedEvents['workshops_2'][] = $event;
            }
        }

        return $formatedEvents;
    }

    public static function error(Router $router) {
        $router->render('pages/error404', [
            'title' => 'Página no encontrada'
        ]);
    }

}