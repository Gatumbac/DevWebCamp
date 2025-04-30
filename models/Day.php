<?php

namespace Model;

class Day extends ActiveRecord {
    protected static $dbTable = 'DAYS';
    protected static $dbColumns = ['id', 'name'];

    protected $id;
    protected $name;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function validate() {
        self::$alerts = [];
        if(!$this->name || strlen(trim($this->name)) < 3) {
            self::$alerts['error'][] = 'El Nombre del día es Obligatorio y debe ser valido';
        }
        return self::$alerts;
    }
}