<?php

namespace App\Actions;

use App\DataTransferObjects\RegisterData;
use App\Models\User;

class RegisterAction
{
    public function __construct(RegisterData $registerData)
    {
        $user = new User($registerData->toArray());

        $user->save();
    }
}
