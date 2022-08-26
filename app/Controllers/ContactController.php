<?php

namespace App\Controllers;

class ContactController extends Controller
{
    public function index()
    {
        return $this->render('contact');
    }

    public function store()
    {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        exit;
    }
}
