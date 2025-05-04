<?php

namespace Controllers;

use Model\Speaker;

class SpeakerAPI {
    public static function index() {
        $speakers = Speaker::all();
        
        echo json_encode($speakers);
    }
}