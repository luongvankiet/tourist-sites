<?php

namespace App\Controllers;

use App\Actions\LoginAction;
use App\Actions\RegisterAction;
use App\Controllers\Controller;
use App\Core\Application;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\DataTransferObjects\LoginData;
use App\DataTransferObjects\RegisterData;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('layouts.auth');

        if ($request->isGet()) {
            return $this->render('auth.login');
        }

        $loginData = new LoginData($request->getBody());

        if ($loginData->validate()) {
            $loginAction = new LoginAction($loginData);
        }

        return $this->render('auth.login', [
            'data' => $loginData
        ]);
    }

    public function register(Request $request)
    {
        $this->setLayout('layouts.auth');

        if ($request->isGet()) {
            return $this->render('auth.register');
        }

        $registerData = new RegisterData($request->getBody());

        if ($registerData->validate()) {
            $requestAction = (new RegisterAction($registerData));
            Session::setFlash('success', 'Successfully register!');
            Response::redirect('/');
        }

        return $this->render('auth.register', [
            'data' => $registerData
        ]);
    }
}
