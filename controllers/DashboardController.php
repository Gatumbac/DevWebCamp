<?php
namespace Controllers;

use Model\AdminRegistration;
use Model\Event;
use Model\Registration;
use MVC\Router;

class DashboardController {
    public static function index(Router $router) {
        isAdmin();
        $registrations = AdminRegistration::limitSQL(AdminRegistration::getSQL(), 'id', 'DESC', 5);
        $income = self::getIncome();
        $lowSeatsEvents = Event::order('seat_quantity', 'ASC', 5);
        $highSeatsEvents = Event::order('seat_quantity', 'DESC', 5);


        $router->render('admin/dashboard/index', [
            'title' => 'Panel de Administración',
            'registrations' => $registrations,
            'income' => $income, 
            'lowSeatsEvents' => $lowSeatsEvents,
            'highSeatsEvents' => $highSeatsEvents
        ]);
    }

    public static function getIncome() : float {
        $onlineUsers = (int) Registration::total('package_id', 2);
        $onsiteUsers = (int) Registration::total('package_id', 1);
        $onlineIncome = 46.05;
        $onsiteIncome = 187.95;

        return ($onlineUsers * $onlineIncome) + ($onsiteUsers * $onsiteIncome);
    }
}