<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // show the homepage
    public function showHomepage() {
        return view('homepage');
    }
}
