<?php

namespace Controllers;

use Model\Event;

class EventAPI {
    public static function index() {
        $day_id = $_GET['day_id'] ?? '';
        $category_id = $_GET['category_id'] ?? '';

        $day_id = filter_var($day_id, FILTER_VALIDATE_INT);
        $category_id = filter_var($category_id, FILTER_VALIDATE_INT);
        
        if(!$day_id || !$category_id) {
            echo json_encode([]);
            return;
        }
        
        $events = Event::whereArray(['day_id' => $day_id, 'category_id' => $category_id]);
        echo json_encode($events);
    }
}