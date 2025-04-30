<?php

namespace Model;

class Hour extends ActiveRecord {
    protected static $dbTable = 'HOURS';
    protected static $dbColumns = ['id', 'hour'];

    protected $id;
    protected $hour;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hour = $args['hour'] ?? '';
    }

    public function getId() {
        return $this->id;
    }

    public function getHour() {
        return $this->hour;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setHour($hour) {
        $this->hour = $hour;
    }

    public function validate() {
        self::$alerts = [];
        if(!$this->hour || strlen(trim($this->hour)) < 3) {
            self::$alerts['error'][] = 'La hora es Obligatoria y debe ser valida';
        }
        return self::$alerts;
    }
}