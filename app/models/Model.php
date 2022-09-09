<?php

namespace App\Models;

use App\Core\Application;
use Exception;

abstract class Model
{
    protected $table;
    protected $attributes = [];
    protected static $query;
    protected static $statement;

    public function __construct(array $parameters = []) {
        foreach ($parameters as $propertyName => $value) {
            if (property_exists($this, $propertyName)) {
                $this->{$propertyName} = $value;
            }
        }
    }

    public function getTableName()
    {
        return $this->table;
    }

    public function save()
    {
        if (empty($this->table)) {
            return false;
        }

        try {
            $params = array_map(function ($param) {
                return ":$param";
            }, $this->attributes);

            $this->prepareStatement("INSERT INTO $this->table (" . implode(',', $this->attributes) . ") VALUES (" . implode(',', $params) . ")");

            foreach ($this->attributes as $attribute) {
                self::$statement->bindValue(":$attribute", $this->{$attribute});
            }

            self::$statement->execute();
            return true;
        } catch(Exception) {
            return false;
        }
    }

    public static function prepareStatement($sql)
    {
        return self::$statement = Application::$app->db->pdo->prepare($sql);
    }

    public function query(): self
    {
        self::$query = "SELECT * FROM $this->table ";
        return $this;
    }

    public function where($column, $value = null, $operator = '=', $boolean = 'and'): self
    {
        if (empty(self::$query)) {
            $this->query();
        }

        if (strpos(self::$query, 'WHERE')) {
            self::$query .= "$boolean ";
        }

        self::$query .= "WHERE $column $operator :value";
        $this->prepareStatement(self::$query);
        self::$statement->bindValue(":value", $value);

        return $this;
    }

    public function get()
    {
        if (empty(self::$query)) {
            $this->query();
            $this->prepareStatement(self::$query);
        }

        self::$statement->execute();
        return self::$statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function first()
    {
        if (empty(self::$query)) {
            $this->query();
            $this->prepareStatement(self::$query);
        }

        self::$statement->execute();
        return self::$statement->fetchObject();
    }
}
