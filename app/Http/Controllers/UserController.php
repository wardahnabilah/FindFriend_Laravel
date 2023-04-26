<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show the homepage
    public function showHomepage() {
        return view('homepage');
    }

    // Show login page
    public function showLoginPage() {
        return view('login-page');
    }

    // Add user to database (Create new user)
    public function addUser(Request $request) {
        $newUser = $request->validate([
            'username' => ['required', 'min:3', 'max:15', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        // Hash the password before storing it in the database
        $newUser["password"] = bcrypt($newUser["password"]);

        // Store new user data into database
        User::create($newUser);
    }

    // Log in
    public function login(Request $request) {
        $userLogin = $request->validate([
            "usernameLogin" => "required",
            "passwordLogin" => "required"
        ]);

        // Check if username and password are matched with data in the database
        if(auth()->attempt(["username" => $userLogin["usernameLogin"], "password" => $userLogin["passwordLogin"]])) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Successfully Logged In');
        } else {
            return redirect('/login')->with('failed', 'Username or password is wrong');
        }
    }

}
