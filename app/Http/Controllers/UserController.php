<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user()
    {
        $title = "user";
        $users = User::all();

        return view("DataUser/user", compact("title","users"));
    }

    public function create()
    {
        $title = 'Tambah User'; // Define the title
        return view('DataUser.tambah', compact('title')); // Pass the title to the view
    }




}
