<?php
namespace Model;

abstract class ActiveRecord implements \JsonSerializable {
    protected static $db;
    protected static $dbTable = '';
    protected static $dbColumns = [];
    protected static $alerts = [];
    protected $id;

    protected static $lastError = '';

    protected static function recordError($message) {
        self::$lastError = $message;
    }
    
    public static function getLastError() {
        return self::$lastError;
    }

    public abstract function validate();

    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    public static function getAlerts() {
        return static::$alerts;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$dbTable;
        $array = static::queryTable($query);
        return $array;
    }

    public static function get($number, $order) {
        $order = strtoupper($order);
        if (!in_array($order, ['ASC', 'DESC'])) {
            static::recordError("Invalid order parameter.");
            return [];
        }

        $number = intval($number);
        $query = "SELECT * FROM " . static::$dbTable . " ORDER BY id {$order} LIMIT {$number}";
        $array = static::queryTable($query);
        return $array;
    }

    public static function find($id) {
        $id = self::$db->escape_string($id);
        $query = "SELECT * FROM " . static::$dbTable . " WHERE id = {$id}";
        $result = static::queryTable($query);
        return array_shift($result);
    }

    public static function where($column, $value) {
        $column = self::$db->escape_string($column);
        $value = self::$db->escape_string($value);
        $query = "SELECT * FROM " . static::$dbTable . " WHERE " . $column . " = '{$value}'";
        $result = static::queryTable($query);
        return array_shift($result);
    }

    public static function whereArray($array = []) {
        $filter = '';
        foreach($array as $key => $value) {
            if($key === array_key_last($array)) {
                $filter .= "{$key}='{$value}'";
            } else {
                $filter .= "{$key}='{$value}' AND ";
            }
        }
        $query = "SELECT * FROM " . static::$dbTable . " WHERE " . $filter;
        return static::queryTable($query);
    }

    public static function belongsTo($column, $value) {
        $column = self::$db->escape_string($column);
        $value = self::$db->escape_string($value);
        $query = "SELECT * FROM " . static::$dbTable . " WHERE " . $column . " = '{$value}'";
        return static::queryTable($query);
    }

    public static function order($column, $order) {
        $column = self::$db->escape_string($column);
        $order = self::$db->escape_string($order);

        if (!in_array(strtoupper($order), ['ASC', 'DESC'])) {
            static::recordError("Invalid order parameter.");
            return [];
        }

        $query = "SELECT * FROM " . static::$dbTable . " ORDER BY {$column} {$order}";
        return static::queryTable($query);
    }

    public static function paginate($recordsPerPage, $offset) {
        $recordsPerPage = self::$db->escape_string($recordsPerPage);
        $offset = self::$db->escape_string($offset);
        $query = "SELECT * FROM " . static::$dbTable . " LIMIT {$recordsPerPage} OFFSET {$offset}";
        $result = static::queryTable($query);
        return $result;
    }

    //Unrestricted querys -> Relational Tables Using JOINS
    public static function SQL($query) {
        $array = static::queryTable($query);
        return $array;
    }

    public static function paginateSQL($SQL, $recordsPerPage, $offset) {
        $recordsPerPage = self::$db->escape_string($recordsPerPage);
        $offset = self::$db->escape_string($offset);
        $query = $SQL . "LIMIT {$recordsPerPage} OFFSET {$offset}";
        $result = static::queryTable($query);
        return $result;
    }

    public static function orderSQL($SQL, $column, $order) {
        $column = self::$db->escape_string($column);
        $order = self::$db->escape_string($order);

        if (!in_array(strtoupper($order), ['ASC', 'DESC'])) {
            static::recordError("Invalid order parameter.");
            return [];
        }

        $query = $SQL . "ORDER BY {$column} {$order}";
        return static::queryTable($query);
    }

    //DB Operations
    public static function total($column = '', $value = '') {
        $column = self::$db->escape_string($column);
        $value = self::$db->escape_string($value);
        $query = "SELECT COUNT(*) FROM " . static::$dbTable;
        if ($column) {
            $query .= " WHERE {$column} = {$value}";
        }
        $result = self::$db->query($query);
        $total = $result->fetch_array();
        return array_shift($total);
    }

    public function save() {
        if(!$this->id) {
            $result = $this->create();
        } else {
            $result = $this->update();
        }
        return $result;
    }
    
    public function create() {
        $attributes = $this->sanitizeData();
        $stringColumns = join(", ", array_keys($attributes));
        $stringValues = join("', '", array_values($attributes));

        $query = "INSERT INTO " . static::$dbTable ."(" . $stringColumns . ") VALUES ('" . $stringValues . "')";

        try {
            $result = self::$db->query($query);
        } catch (\Throwable $th) {
            static::recordError($th->getMessage());
        }

        return [
            'result' =>  $result ?? false,
            'error' => static::getLastError(),
            'id' => self::$db->insert_id
        ];
    }

    public function update() {
        $attributes = $this->sanitizeData();
        $values = [];

        foreach($attributes as $key=>$value) {
            if ($value === "NULL") {
                $values[] = "{$key}=NULL";
            } else {
                $values[] = "{$key}='{$value}'";
            }
        }

        $id = self::$db->escape_string($this->id);
        $query = "UPDATE ". static::$dbTable ." SET " . join(", ", $values) . " WHERE id = '{$id}' LIMIT 1";

        try {
            $result = self::$db->query($query);
        } catch (\Throwable $th) {
            static::recordError($th->getMessage());
        }

        return [
            'result' =>  $result ?? false,
            'error' => static::getLastError(),
            'id' => $this->id
        ];
    }

    public function delete() {
        $id = self::$db->escape_string($this->id);
        $query = "DELETE FROM " . static::$dbTable . " WHERE id={$id} LIMIT 1";

        try {
            $result = self::$db->query($query);
        } catch (\Throwable $th) {
            static::recordError($th->getMessage());
        }

        return [
            'result' =>  $result ?? false,
            'error' => static::getLastError(),
            'id' => $this->id
        ];
    }

    public function getAttributes() {
        $attributes = [];
        foreach (static::$dbColumns as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    public function sanitizeData() {
        $attributes = $this->getAttributes();
        $sanitized = [];

        foreach ($attributes as $column => $value) {
            if ($value === null) {
                $sanitized[$column] = "NULL";
            } else {
                if (is_string($value)) {
                    $value = trim($value);
                }
                $sanitized[$column] = self::$db->escape_string($value);
            }
        }
        return $sanitized;
    }

    public static function queryTable($query) {
        $result = self::$db->query($query);
        $array = [];
        while ($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }
        return $array;
    }

    public static function createObject(array $record) {
        $object = new static($record);
        return $object;
    }

    public function sync(array $attributes = []) {
        foreach($attributes as $attribute=>$value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }

    public function jsonSerialize(): mixed {
        $vars = get_object_vars($this);
        return $vars;
    }
}