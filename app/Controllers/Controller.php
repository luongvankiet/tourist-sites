<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Router;

class Controller
{
    private Application $app;

    public function __construct() {
        $this->app = new Application(Application::$ROOT_DIR);
    }

    public function render($view, $params = [])
    {
        return $this->app->router->renderView($view, $params);
    }
}
