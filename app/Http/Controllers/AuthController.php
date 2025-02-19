<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $title = "login"; // Corrected typo here
        
        return view("auth.login", compact("title"));
    }
}
