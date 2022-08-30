<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isGet()) {
            return $this->render('auth.login');
        }

        return 'Do something!';
    }

    public function register(Request $request)
    {
        if ($request->isGet()) {
            return $this->render('auth.register');
        }

        return 'Do something!';
    }
}
