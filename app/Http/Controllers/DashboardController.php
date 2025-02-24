<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $title = "dashboard"; // Corrected typo here

        return view("dashboard", compact("title"));
    }
}
