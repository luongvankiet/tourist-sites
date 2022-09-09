<?php

namespace App\DataTransferObjects;

use App\Core\Application;

abstract class DataTransferObject
{
    public const REQUIRED = 'required';
    public const EMAIL = 'email';
    public const MIN = 'min';
    public const MAX = 'max';
    public const MATCH = 'match';
    public const UNIQUE = 'unique';

    public array $rules = [];
    public array $errors = [];

    public function __construct(array $parameters = []) {
        foreach ($parameters as $propertyName => $value) {
            if (property_exists($this, $propertyName)) {
                $this->{$propertyName} = $value;
            }
        }
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::REQUIRED && !$value) {
                    $this->addErrors($attribute, self::REQUIRED);
                }

                if ($ruleName === self::EMAIL && filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, self::EMAIL);
                }

                if (($rule['min'] ?? false) && $ruleName === self::MIN && strlen($value) < $rule['min']) {
                    $this->addErrors($attribute, self::MIN, $rule);
                }

                if (($rule['max'] ?? false) && $ruleName === self::MAX && strlen($value) < $rule['max']) {
                    $this->addErrors($attribute, self::MAX, $rule);
                }

                if (($rule['match'] ?? false) && $ruleName === self::MATCH && $value !== $this->{$rule['match']}) {
                    $this->addErrors($attribute, self::MATCH, $rule);
                }

                if ($ruleName === self::UNIQUE) {
                    $class = new $rule['class']();
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $object = $class->where($uniqueAttribute, $value)->first();

                    if ($object) {
                        $this->addErrors($attribute, self::UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function addErrors(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessage(): array
    {
        return [
            self::REQUIRED => 'This field is required',
            self::EMAIL => 'This field must be a valid email',
            self::MIN => 'This field must be more than or equal to {min}',
            self::MAX => 'This field must be less than or equal to {max}',
            self::MATCH => 'This field must be the same as {match}',
            self::UNIQUE => 'This {field} is already exists',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }
}
