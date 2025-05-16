<?php

namespace Model;

class AdminRegistration extends ActiveRecord {
    protected static $dbTable = '';
    protected static $dbColumns = ['id', 'user_id', 'user_name', 'user_email', 'package_id', 'package_name'];

    protected $id;
    protected $user_id;
    protected $user_name;
    protected $user_email;
    protected $package_id;
    protected $package_name;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? null;
        $this->user_name = $args['user_name'] ?? '';
        $this->user_email = $args['user_email'] ?? '';
        $this->package_id = $args['package_id'] ?? null;
        $this->package_name = $args['package_name'] ?? '';
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function getPackageId() {
        return $this->package_id;
    }

    public function getPackageName() {
        return $this->package_name;
    }


    public static function getSQL() {
        
        $query = "SELECT r.id AS id, u.id AS user_id, CONCAT(u.name, ' ', u.lastname) AS user_name, u.email AS user_email, p.id AS package_id, p.name AS package_name";
        $query .= " FROM REGISTRATIONS r ";
        $query .= " LEFT JOIN USERS u ON r.user_id = u.id ";
        $query .= " LEFT JOIN PACKAGES p ON r.package_id = p.id ";

        return $query;
    }

    public function validate() {
        self::$alerts = [];
        return self::$alerts;
    }

}