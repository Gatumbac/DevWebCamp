<?php
namespace Controllers;

use Classes\FlashMessage;
use Classes\Paginator;
use Model\AdminEvent;
use Model\Category;
use Model\Day;
use Model\Hour;
use Model\Event;
use MVC\Router;

class EventController {
    public static function index(Router $router) {
        isAdmin();
        $currentPage = $_GET['page'] ?? '';
        $currentPage = filter_var($currentPage, FILTER_VALIDATE_INT);
        if (!$currentPage || $currentPage < 1) {
            redirect('/admin/eventos?page=1');
        }

        $recordsPerPage = 10;
        $totalRecords = Event::total();

        $paginator = new Paginator($currentPage, $recordsPerPage, $totalRecords);
        if ($currentPage > $paginator->getTotalPages()) {
            redirect('/admin/eventos?page=1');
        }

        $events = AdminEvent::paginateSQL(AdminEvent::getSQL(), $recordsPerPage, $paginator->getOffset());

        $router->render('admin/events/index', [
            'title' => 'Conferencias y Workshops',
            'events' => $events,
            'pagination' => $paginator->pagination()
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

    public static function update(Router $router) {
        isAdmin();
        $event = self::getEventByForm($_GET);
        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();

        $router->render('admin/events/update', [
            'title' => 'Editar Evento',
            'event' => $event,
            'categories' => $categories, 
            'days' => $days,
            'hours' => $hours,
            'view_scripts' => []
        ]);
    }

    public static function processUpdate(Router $router) {
        isAdmin();
        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();

        $event = self::getEventByForm($_GET);
        $event->sync($_POST);
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

        $router->render('admin/events/update', [
            'title' => 'Editar Evento',
            'event' => $event,
            'alerts' => $alerts,
            'categories' => $categories, 
            'days' => $days,
            'hours' => $hours,
            'view_scripts' => []
        ]);
    }

    public static function delete() {
        isAdmin();
        $event = self::getEventByForm($_POST);
        $result = $event->delete();
        if($result['result']) {
            FlashMessage::setSuccess();
        } else {
            FlashMessage::setDependencyError();
        }
        redirect('/admin/eventos');
    }

    public static function getEventByForm($array) {
        $id = s($array['id'] ?? '');
        $id = filter_var($id, FILTER_VALIDATE_INT);
        verify($id, '/admin/eventos');

        $event = Event::find($id);
        verify($event, '/admin/eventos');
        return $event;
    }
}