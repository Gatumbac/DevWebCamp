<?php

namespace Model;

class Event extends ActiveRecord {
    protected static $dbTable = 'EVENTS';
    protected static $dbColumns = ['id', 'name', 'description', 'seat_quantity', 'category_id', 'day_id', 'hour_id', 'speaker_id'];

    protected $id;
    protected $name;
    protected $description;
    protected $seat_quantity;
    protected $category_id;
    protected $day_id;
    protected $hour_id;
    protected $speaker_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->seat_quantity = $args['seat_quantity'] ?? ''; 
        $this->category_id = $args['category_id'] ?? '';
        $this->day_id = $args['day_id'] ?? '';
        $this->hour_id = $args['hour_id'] ?? '';
        $this->speaker_id = $args['speaker_id'] ?? '';
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getSeatQuantity() {
        return $this->seat_quantity;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getDayId() {
        return $this->day_id;
    }

    public function getHourId() {
        return $this->hour_id;
    }

    public function getSpeakerId() {
        return $this->speaker_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setSeatQuantity($seat_quantity) {
        $this->seat_quantity = $seat_quantity;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function setDayId($day_id) {
        $this->day_id = $day_id;
    }

    public function setHourId($hour_id) {
        $this->hour_id = $hour_id;
    }

    public function setSpeakerId($speaker_id) {
        $this->speaker_id = $speaker_id;
    }


    public function validate() {
        self::$alerts = [];

        if(!$this->name || strlen(trim($this->name)) < 3) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio y debe ser válido';
        }
        if(!$this->description || strlen(trim($this->description)) < 50) {
            self::$alerts['error'][] = 'La descripción es Obligatoria y debe tener al menos 50 caracteres';
        }
        if(!$this->category_id  || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige una Categoría';
        }
        if(!$this->day_id  || !filter_var($this->day_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige el Día del evento';
        }
        if(!$this->hour_id  || !filter_var($this->hour_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige la hora del evento';
        }
        if(!$this->seat_quantity  || !filter_var($this->seat_quantity, FILTER_VALIDATE_INT) || (int) $this->seat_quantity < 0) {
            self::$alerts['error'][] = 'Añade una cantidad válida de Lugares Disponibles';
        }
        if(!$this->speaker_id || !filter_var($this->speaker_id, FILTER_VALIDATE_INT) ) {
            self::$alerts['error'][] = 'Selecciona la persona encargada del evento';
        }

        return self::$alerts;
    }

}