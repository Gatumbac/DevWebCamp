<?php

namespace Model;

class AdminEvent extends ActiveRecord {
    protected static $dbTable = '';
    protected static $dbColumns = ['id', 'name', 'description', 'seats', 'category', 'day', 'hour', 'speaker'];

    protected $id;
    protected $name;
    protected $description;
    protected $seats;
    protected $category;
    protected $day;
    protected $hour;
    protected $speaker;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->seats = $args['seats'] ?? ''; 
        $this->category = $args['category'] ?? null;
        $this->day = $args['day'] ?? null;
        $this->hour = $args['hour'] ?? null;
        $this->speaker = $args['speaker'] ?? null;
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

    public function getSeats() {
        return $this->seats;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getDay() {
        return $this->day;
    }

    public function getHour() {
        return $this->hour;
    }

    public function getSpeaker() {
        return $this->speaker;
    }

    public static function getSQL() {
        
        $query = "SELECT e.id AS id, e.name AS name, e.description AS description, e.seat_quantity AS seats, c.name AS category, d.name AS day, h.hour AS hour, CONCAT(s.name, ' ', s.lastname) AS speaker";
        $query .= " FROM EVENTS e ";
        $query .= " LEFT JOIN CATEGORIES c ON e.category_id = c.id ";
        $query .= " LEFT JOIN DAYS d ON e.day_id = d.id ";
        $query .= " LEFT JOIN HOURS h ON e.hour_id = h.id ";
        $query .= " LEFT JOIN SPEAKERS s ON e.speaker_id = s.id ";

        return $query;
    }


    public function validate() {
        self::$alerts = [];
        return self::$alerts;
    }

}