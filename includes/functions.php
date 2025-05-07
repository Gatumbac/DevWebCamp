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

function verifyAuth() {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['login']);
}

function verifyAdmin() {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION['admin']);
}

function isAdmin() {
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('Location: /login');
        exit;
    }
}

function verifyActualPage(string $path) : bool {
    $url = $_SERVER['PATH_INFO'] ?? '';
    return str_contains($url, $path);
}

function aos_animation() : string {
    $efects = ["fade-up", "fade-down", "fade-left", "fade-right", "flip-left", "fade-right", "zoom-in", "zoom-in-up", "zoom-in-down", "zoom-out"];
    $efect = array_rand($efects);
    return $efects[$efect];
}
