<?php

namespace Model;

class AdminEvent extends ActiveRecord {
    protected static $dbTable = '';
    protected static $dbColumns = ['id', 'name', 'description', 'seats', 'category_id', 'category', 'day_id', 'day', 'hour_id', 'hour', 'speaker_id', 'speaker_image', 'speaker'];

    protected $id;
    protected $name;
    protected $description;
    protected $seats;
    protected $category_id;
    protected $category;
    protected $day_id;
    protected $day;
    protected $hour_id;
    protected $hour;
    protected $speaker_id;
    protected $speaker_image;
    protected $speaker;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->seats = $args['seats'] ?? ''; 
        $this->category_id = $args['category_id'] ?? '';
        $this->category = $args['category'] ?? '';
        $this->day_id = $args['day_id'] ?? '';
        $this->day = $args['day'] ?? '';
        $this->hour_id = $args['hour_id'] ?? '';
        $this->hour = $args['hour'] ?? '';
        $this->speaker_id = $args['speaker_id'] ?? '';
        $this->speaker_image = $args['speaker_image'] ?? '';
        $this->speaker = $args['speaker'] ?? '';
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

    public function getSpeakerImg() {
        return $this->speaker_image;
    }

    public static function getSQL() {
        
        $query = "SELECT e.id AS id, e.name AS name, e.description AS description, e.seat_quantity AS seats, c.id AS category_id,  c.name AS category, d.id AS day_id, d.name AS day, h.id AS hour_id,  h.hour AS hour, s.id AS speaker_id, s.image AS speaker_image, CONCAT(s.name, ' ', s.lastname) AS speaker";
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