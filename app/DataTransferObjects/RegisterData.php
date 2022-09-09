<?php

namespace App\DataTransferObjects;

use App\Models\User;

class RegisterData extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    public function rules(): array
    {
        return $this->rules = [
            'first_name' => [self::REQUIRED],
            'last_name' => [self::REQUIRED],
            'email' => [self::REQUIRED, self::MAX, [self::UNIQUE, 'class' => User::class, 'attribute' => 'email']],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 8]],
            'password_confirmation' => [self::REQUIRED, [self::MATCH, 'match' => 'password']]
        ];
    }

    public function toArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];
    }
}
