<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
}
