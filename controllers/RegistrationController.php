<?php

namespace Controllers;

use Classes\FlashMessage;
use Model\Event;
use Model\EventRegistration;
use Model\Gift;
use Model\Package;
use Model\Registration;
use MVC\Router;

class RegistrationController {
    public static function registration(Router $router) {
        isAuth();

        self::redirectToTicket();
        
        $router->render('registration/create', [
            'title' => 'Finalizar Registro',
            'isUserRegistration' => true
        ]); 
    }

    public static function freePlan() {
        isAuth();
        self::redirectToTicket();

        $token = substr( md5(uniqid(rand(), true)), 0 , 8);
        $packageId = 3;
        $registrationData = [
            'package_id' => $packageId,
            'user_id' => (int) $_SESSION['id'],
            'pay_id' => '',
            'token' => $token
        ];

        $registration = new Registration($registrationData);
        if(empty($registration->validate())) {
            $result = $registration->save();
            if ($result['result']) {
                FlashMessage::setSuccess();
                $url = urlencode($registration->getToken());
                redirect("/boleto?id={$url}");
            }
        }
        FlashMessage::setError();
    }

    public static function ticket(Router $router) {
        isAuth();
        $registration = self::validateTicket($_GET);
        $userName = $_SESSION['name'];

        $packageDicc = ['presencial' => 'onsite', 'virtual' => 'online', 'gratis' => 'free'];
        $package = Package::find($registration->getPackageId());
        $packageName = $package->getName();
        $packageClass = $packageDicc[strtolower($packageName)];


        $router->render('registration/ticket', [
            'title' => 'Asistencia a DevWebCamp',
            'registration' => $registration,
            'userName' => $userName,
            'package' => ['name' => $packageName, 'class' => $packageClass]
        ]); 
    }

    public static function validateTicket($get) {
        $id = $get['id'] ?? '';
        if (!$id || strlen($id) !== 8) {
            redirect('/');
        }

        $registration = Registration::where('token', $id);
        verify($registration, '/');

        if ($registration->getUserId() !== $_SESSION['id']) {
            redirect('/');
        }

        return $registration;
    }

    public static function redirectToTicket() {
        $registration = self::getRegistration();
        if ($registration) {
            $url = urlencode($registration->getToken());
            redirect("/boleto?id={$url}");
        }
    }

    public static function getRegistration() {
        $registration = Registration::where('user_id', $_SESSION['id']);
        return $registration ?? false;
    }

    public static function pay() {
        isAuth();

        if(empty($_POST)) {
            echo json_encode(['result' => false, 'error' => 'No data provided']);
            return;
        }

        $data = $_POST;
        $data['token'] = substr( md5(uniqid(rand(), true)), 0 , 8);
        $data['user_id'] = $_SESSION['id'];

        $registration = new Registration($data);
        if(empty($registration->validate())) {
            $result = $registration->save();
            echo json_encode($result);
        } else {
            echo json_encode(['result' => false, 'error' => 'Invalid Registration Parameters']);
        }
    }

    public static function conferences(Router $router) {
        isAuth();

        $registration = self::getRegistration();
        if(!$registration) {
            redirect('/finalizar-registro');
        }
        if($registration->getPackageId() !== '1') {
            redirect('/');
        }
        
        $registrationEvent = EventRegistration::where('registration_id', $registration->getId());
        if(isset($registrationEvent)) {
            self::redirectToTicket();
        }

        $formatedEvents = PageController::getFormatedEvents();
        $gifts = Gift::all();

        $router->render('registration/conferences', [
            'title' => 'Elige Workshops y Conferencias',
            'events' => $formatedEvents,
            'gifts' => $gifts,
            'view_scripts' => []
        ]);
    }

    public static function saveRegistration() {
        isAuth();
        $events = self::getEvents($_POST);
        $gift_id = $_POST['gift_id'] ?? '';
        $gift_id = filter_var($gift_id, FILTER_VALIDATE_INT);

        if (empty($events) || !$gift_id) {
            echo json_encode(['result' => false, 'error' => 'Incomplete Data']);
            return;
        }

        $registration = self::validatePremiumRegistration();
        if(!$registration) {
            return;
        }

        $eventsArray = self::validateEvents($events);
        if (!$eventsArray) {
            return;
        }

        self::saveEvents($eventsArray, $registration->getId());

        $result = self::saveGift($registration, $gift_id);

        echo json_encode(['result' => $result['result'], 'error' => $result['error'], 'token' => $registration->getToken()]);
    }

    public static function getEvents(array $post) {
        $events_id = $post['events_id'] ?? '';
        $events_id = explode(',', $events_id);

        $events_id = array_filter($events_id, function($id) {
            return is_numeric($id) && $id > 0;
        });

        return $events_id;
    }

    public static function validateEvents(array $events) {
        $eventsArray = [];
        foreach($events as $event_id) {
            $event = Event::find($event_id);
            if (!isset($event) || $event->getSeatQuantity() === "0") {
                echo json_encode(['result' => false, 'error' => 'Invalid Events Or Seats']);
                return false;
            }
            $eventsArray[] = $event;
        }
        return $eventsArray;
    }

    public static function saveEvents($eventsArray, $registration_id) {
        foreach($eventsArray as $event) {
            $event->setSeatQuantity($event->getSeatQuantity() - 1);
            $event->save();
            self::saveEventRegistration($event->getId(), $registration_id);
        }
    }

    public static function saveEventRegistration($event_id, $registration_id) {
        $data = [
            'event_id' => (int) $event_id,
            'registration_id' => (int) $registration_id
        ];
        $eventRegistration = new EventRegistration($data);
        $eventRegistration->save();
    }

    public static function saveGift($registration, $gift_id) {
        $registration->setGiftId($gift_id);
        $result = $registration->save();
        return $result;
    }

    public static function validatePremiumRegistration() {
        $registration = self::getRegistration();
        if(!$registration || $registration->getPackageId() !== "1") {
            echo json_encode(['result' => false, 'error' => 'Incomplete Registration']);
            return false;
        }
        return $registration;
    }
}