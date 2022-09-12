<?php

namespace App\Core;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public static function redirect($path = '/')
    {
        $path = Application::$APP_URL . $path;

        header('Location: '.$path);
    }
}
