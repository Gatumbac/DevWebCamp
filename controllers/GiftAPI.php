<?php

namespace Controllers;

use Model\Event;
use Model\Gift;
use Model\Registration;

class GiftAPI {
    public static function index() {
        if(!verifyAdmin()) {
            echo json_encode([]);
            return;
        }

        $gifts = Gift::all();
        $data = [];
        foreach($gifts as $gift) {
            $data[$gift->getName()] = Registration::totalArray(['gift_id' => $gift->getId(), 'package_id' => '1']);
        }
        echo json_encode($data);
    }
}