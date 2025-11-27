<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddableController extends Controller
{
    public function showIndex()
    {
        return view('addable.index');
    }
}
