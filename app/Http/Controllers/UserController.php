<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Login;

class UserController extends Controller
{
    public function showIndex()
    {
        return view('users-index');
    }
}
