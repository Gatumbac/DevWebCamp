<?php

namespace Model;

class Speaker extends ActiveRecord {
    protected static $dbTable = 'SPEAKERS';
    protected static $dbColumns = ['id', 'name', 'lastname', 'city', 'country', 'image', 'tags', 'networks'];

    public $id;
    public $name;
    public $lastname;
    public $city;
    public $country;
    public $image;
    public $tags;
    public $networks;

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

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
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
        if(!$this->name || strlen($this->name) < 3) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio y debe ser válido';
        }
        if(!$this->lastname || strlen($this->lastname) < 3) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio y debe ser válido';
        }
        if(!$this->city || strlen($this->city) < 3) {
            self::$alerts['error'][] = 'El Campo Ciudad es Obligatorio';
        }
        if(!$this->country || strlen($this->country) < 3) {
            self::$alerts['error'][] = 'El Campo País es Obligatorio';
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