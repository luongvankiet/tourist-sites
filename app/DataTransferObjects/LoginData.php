<?php

namespace App\DataTransferObjects;

class LoginData extends DataTransferObject
{
    public string $email;
    public string $password;

    public function rules(): array
    {
        return $this->rules = [
            'email' => [self::REQUIRED, self::EMAIL],
            'password' => [self::REQUIRED],
        ];
    }
}
