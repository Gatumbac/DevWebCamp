<?php

namespace Model;

class EventRegistration extends ActiveRecord {
    protected static $dbTable = 'EVENTS_REGISTRATION';
    protected static $dbColumns = ['id', 'event_id', 'registration_id'];

    protected $id;
    protected $event_id;
    protected $registration_id;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->event_id = $args['event_id'] ?? null;
        $this->registration_id = $args['registration_id'] ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function getRegistrationId() {
        return $this->registration_id;
    }

    public function getEventId() {
        return $this->event_id;
    }
    
    public function validate() {
        self::$alerts = [];
        if (!$this->registration_id || !filter_var($this->registration_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'El ID del registro es obligatorio.';
        }
        if (!$this->event_id || !filter_var($this->event_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'El ID del evento es obligatorio.';
        }
        return self::$alerts;
    }
}