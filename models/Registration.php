<?php

namespace Model;

class Registration extends ActiveRecord {
    protected static $dbTable = 'REGISTRATIONS';
    protected static $dbColumns = ['id', 'package_id', 'user_id', 'pay_id', 'token', 'gift_id'];

    protected $id;
    protected $package_id;
    protected $user_id;
    protected $pay_id;
    protected $token;
    protected $gift_id;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->package_id = $args['package_id'] ?? null;
        $this->user_id = $args['user_id'] ?? null;
        $this->pay_id = $args['pay_id'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->gift_id = $args['gift_id'] ?? 1;
    }

    public function getId() {
        return $this->id;
    }

    public function getPackageId() {
        return $this->package_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getPayId() {
        return $this->pay_id;
    }

    public function getToken() {
        return $this->token;
    }

    public function getGiftId() {
        return $this->gift_id;
    }

    public function setGiftId($gift_id) {
        $this->gift_id = $gift_id;
    }
    
    public function validate() {
        self::$alerts = [];
        if (!$this->package_id || !filter_var($this->package_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'El ID del paquete es obligatorio.';
        }
        if (!$this->user_id || !filter_var($this->user_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'El ID del usuario es obligatorio.';
        }
        if (!$this->token || strlen($this->token) > 8) { 
            self::$alerts['error'][] = 'El token es obligatorio y debe ser válido.';
        }
        return self::$alerts;
    }
}