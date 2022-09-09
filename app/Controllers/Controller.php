<?php

namespace App\Controllers;

use App\Core\Application;

class Controller
{
    public string $layout = 'layouts.app';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
}
