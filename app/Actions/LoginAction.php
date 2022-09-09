<?php

namespace App\Actions;

use App\DataTransferObjects\LoginData;
use Models\User;

class LoginAction
{
    public function __construct(LoginData $loginData)
    {
        $user = new User();
    }
}
