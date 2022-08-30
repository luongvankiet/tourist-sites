<?php

namespace App\Controllers;

use App\Core\Request;

class ContactController extends Controller
{
    public function index()
    {
        return $this->render('contact');
    }

    public function store(Request $request)
    {
        //
    }
}
