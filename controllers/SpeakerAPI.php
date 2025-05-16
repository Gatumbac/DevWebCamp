<?php

namespace Controllers;

use Model\Speaker;

class SpeakerAPI {
    public static function index() {
        if(!verifyAdmin()) {
            echo json_encode([]);
            return;
        }
        $speakers = Speaker::all();
        
        echo json_encode($speakers);
    }
}