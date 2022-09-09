<?php

namespace App\DataTransferObjects;

use App\Core\Request;
use Models\User;

class UserData extends DataTransferObject
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public string $password_confirmation;

    //create user data from user model
    public static function createFromModel(User $user)
    {
        //
    }

    //create user data from request
    public function createFromRequest(Request $request)
    {
        //
    }

    public function rules(): array
    {
        return $this->rules = [
            'first_name' => [self::REQUIRED],
            'last_name' => [self::REQUIRED],
            'email' => [self::REQUIRED, self::MAX],
            'password' => [self::REQUIRED, [self::MIN, 'min' => 8]],
            'password_confirmation' => [self::REQUIRED, [self::MATCH, 'match' => 'password']]
        ];
    }
}
