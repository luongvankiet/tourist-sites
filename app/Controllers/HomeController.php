<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Application;
use App\Models\Site;

class HomeController extends Controller
{
    public function index()
    {
        $sites = Site::getInstance()->get();

        return $this->render('home', [
            'sites' => $sites,
            'authenticatedUser' => Application::$app->authenticatedUser
        ]);
    }
}
