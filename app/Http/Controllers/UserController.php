<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show the homepage
    public function showHomepage() {
        return view('homepage');
    }

    // Add user to database
    public function addUser(Request $request) {
        $newUser = $request->validate([
            'username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        // hash the password before storing it in the database
        $newUser["password"] = bcrypt($newUser["password"]);

        // Store new user data into database
        User::create($newUser);
    }
}
