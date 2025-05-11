<?php

namespace Controllers;

use Classes\FlashMessage;
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

        $formatedEvents = PageController::getFormatedEvents();
        $gifts = Gift::all();

        $router->render('registration/conferences', [
            'title' => 'Elige Workshops y Conferencias',
            'events' => $formatedEvents,
            'gifts' => $gifts,
            'view_scripts' => []
        ]);
    }
}