<?php

namespace Model;

class Speaker extends ActiveRecord {
    protected static $dbTable = 'SPEAKERS';
    protected static $dbColumns = ['id', 'name', 'lastname', 'city', 'country', 'image', 'tags', 'networks'];

    protected $id;
    protected $name;
    protected $lastname;
    protected $city;
    protected $country;
    protected $image;
    protected $tags;
    protected $networks;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->city = $args['city'] ?? '';
        $this->country = $args['country'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->networks = $args['networks'] ?? '';
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFullName() {
        return $this->name . ' ' . $this->lastname;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getLocation() {
        return $this->city . ', ' . $this->country;
    }

    public function getImage() {
        return $this->image;
    }

    public function getTags() {
        return $this->tags;
    }

    public function getNetworks() {
        return $this->networks;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setTags($tags) {
        $this->tags = $tags;
    }

    public function setNetworks($networks) {
        $this->networks = $networks;
    }

    public function validate() {
        self::$alerts = [];
        if(!$this->name || strlen(trim($this->name)) < 3) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio y debe ser válido';
        }
        if(!$this->lastname || strlen(trim($this->lastname)) < 3) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio y debe ser válido';
        }
        if(!$this->city || strlen(trim($this->city)) < 2) {
            self::$alerts['error'][] = 'El Campo Ciudad es Obligatorio y debe ser válido';
        }
        if(!$this->country || strlen(trim($this->country)) < 2) {
            self::$alerts['error'][] = 'El Campo País es Obligatorio y debe ser válido';
        }
        if(!$this->image) {
            self::$alerts['error'][] = 'La Imagen es obligatoria';
        }
        if(!$this->tags) {
            self::$alerts['error'][] = 'El Campo Áreas es obligatorio';
        }
        return self::$alerts;
    }


}