<?php
define('IMAGE_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/build/img');

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// HTML scape
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function verify($variable, $location) {
    if (!$variable) {
        redirect($location);
    }
}

function redirect($location) {
    header('Location: ' . $location);
    exit;
}

function isAuth() {
    session_start();
    if (!isset($_SESSION['login'])) {
        header('Location: /login');
        exit;
    }
}

function isAdmin() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: /login');
        exit;
    }
}

function verifyActualPage(string $path) : bool {
    return str_contains($_SERVER['PATH_INFO'], $path);
}
