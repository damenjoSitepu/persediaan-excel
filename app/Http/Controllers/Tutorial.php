<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tutorial extends Controller
{
    public function index()
    {
        return view('tutorial/index');
    }
}
