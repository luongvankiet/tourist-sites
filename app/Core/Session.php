<?php

namespace App\Core;

class Session
{
    protected const FLASH_KEY = 'flash_message';

    public function __construct() {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => $flashMessage) {
            $flashMessage['remove'] = true;

        }
    }

    public function __destruct()
    {
        //
    }

    public static function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public static function getFlash($key)
    {
        # code...
    }
}
