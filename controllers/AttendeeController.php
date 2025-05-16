<?php
namespace Controllers;

use Classes\Paginator;
use Model\AdminRegistration;
use Model\Registration;
use MVC\Router;

class AttendeeController {
    public static function index(Router $router) {
        isAdmin();

        $currentPage = $_GET['page'] ?? '';
        $currentPage = filter_var($currentPage, FILTER_VALIDATE_INT);
        if (!$currentPage || $currentPage < 1) {
            redirect('/admin/registrados?page=1');
        }

        $recordsPerPage = 30;
        $totalRecords = Registration::total();

        $paginator = new Paginator($currentPage, $recordsPerPage, $totalRecords);
        if ($currentPage > $paginator->getTotalPages()) {
            redirect('/admin/registrados?page=1');
        }

        $registrations = AdminRegistration::paginateSQL(AdminRegistration::getSQL(), $recordsPerPage, $paginator->getOffset());


        $router->render('admin/attendees/index', [
            'title' => 'Usuarios Registrados',
            'registrations' => $registrations,
            'pagination' => $paginator->pagination()
        ]);
    }
}