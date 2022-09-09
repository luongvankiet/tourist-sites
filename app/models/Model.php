<?php

namespace App\Models;

use App\Core\Application;
use Exception;

abstract class Model
{
    protected $table;
    protected $primaryKey;
    protected $attributes = [];
    protected $query;
    protected $statement;

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

    public function getPrimaryKey()
    {
        return $this->primaryKey;
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
                $this->statement->bindValue(":$attribute", $this->{$attribute});
            }

            $this->statement->execute();
            return true;
        } catch(Exception) {
            return false;
        }
    }

    public function prepareStatement($sql)
    {
        return $this->statement = Application::$app->db->pdo->prepare($sql);
    }

    public function query(): self
    {
        $this->query = "SELECT * FROM $this->table ";
        return $this;
    }

    public function where($column, $value = null, $operator = '=', $boolean = 'and'): self
    {
        if (empty($this->query)) {
            self::query();
        }

        if (strpos($this->query, 'WHERE')) {
            $this->query .= " $boolean $column $operator :$column";
        } else {
            $this->query .= "WHERE $column $operator :$column";
        }

        $this->prepareStatement($this->query);
        $this->statement->bindValue(":$column", $value);

        return $this;
    }

    public function orWhere($column, $value = null, $operator = '='): self
    {
        return $this->where($column, $value, $operator, 'or');
    }

    public function get()
    {
        if (empty($this->query)) {
            $this->query();
        }
        $this->prepareStatement($this->query);
        $this->statement->execute();

        $results = [];

        foreach ($this->statement->fetchAll() as $value) {
            $results[] = new static($value);
        }

        return $results;
    }

    public function find($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->where($key, $value);
        }

        $this->prepareStatement($this->query);

        foreach ($attributes as $key => $value) {
            $this->statement->bindValue(":$key", $value);
        }

        return self::first();
    }

    public function first()
    {
        if (empty($this->query)) {
            $this->query();
        }

        if (!$this->statement) {
            $this->prepareStatement($this->query);
        }

        $this->statement->execute();

        if (!$result = $this->statement->fetch()) {
            return null;
        }

        return new static($result);
    }
}
