<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Show the homepage
    public function showHomepage() {
        //If logged in, show logged in homepage
        if(auth()->check()) {
            $posts = auth()->user()->feedPosts()->latest()->paginate(3); 

            return view('homepage', ['posts' => $posts]);
        } 
        //If not logged in, show the homepage for guest
        else {
            $allPosts = Post::latest()->paginate(4);

            return view('guest-homepage', ['allPosts' => $allPosts]);
        }
    }

    // Sign up
    public function showSignupPage() {
        return view('signup-page');
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
       $user = User::create($newUser);

        // Automatically login after creating an account
        auth()->login($user);

        return redirect('/')->with('success', 'Account Successfully Created');
    }

    // Log in
    public function showLoginPage() {
        return view('login-page');
    }

    public function login(Request $request) {
        $userLogin = $request->validate([
            'usernameLogin' => 'required',
            'passwordLogin' => 'required'
        ]);

        // Check if username and password are matched with data in the database
        if(auth()->attempt(["username" => $userLogin["usernameLogin"], "password" => $userLogin["passwordLogin"]])) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Successfully Logged In');
        } else {
            return redirect('/login')->with('failed', 'Username or password is wrong');
        }
    }

    // Log out
    public function logout() {
        auth()->logout();

        return redirect('/login')->with('success', 'Successfully Log out');
    }

    // Profile Data
    private function getProfileData($user) {
        if(!auth()->check()) {
            $alreadyFollowed = false;
        } else {
            $alreadyFollowed = Follow::where([['user_id', '=', auth()->user()->id], ['follow_this_user', '=', $user->id]])->count();
        }
        View::share('profileData', [
            'alreadyFollowed' => $alreadyFollowed,
            'userAvatar' => $user->avatar,
            'username' => $user->username,
            'postCount' => $user->posts()->get()->count(),
            'followersCount' => $user->followers()->get()->count(),
            'followingCount' => $user->following()->get()->count()
        ]);
    }

    // Show the profile
    public function showProfile(User $user) {
        $this->getProfileData($user);

        return view('profile', ['posts' => $user->posts()->latest()->paginate(3)]);
    }

    // Show the followers in profile
    public function showProfileFollowers(User $user) {
        $this->getProfileData($user);

        $followers = $user->followers()->latest()->get();
        $following = $user->following()->latest()->get();
        
        // Store the id of the user following in followingId array
        $followingId = array();

        foreach($following as $eachfollowing) {
            array_push($followingId, $eachfollowing->follow_this_user);
        }

        return view('profile-followers', ['followers' => $followers, 'followingId' => $followingId]);
    }

    // Show the following in profile
    public function showProfileFollowing(User $user) {
        $this->getProfileData($user);

        $following = $user->following()->latest()->get();

        return view('profile-following', ['following' => $following]);
    }

    // Show edit profile
    public function showEditProfile() {
        return view('edit-profile');
    }

    // Store the avatar in folder
    public function storeAvatar(Request $request) {
        $newAvatar = $request->validate([
            'avatar' => ['required','image','max:10000']
        ]);

        // Resize the image to smaller size
        $resizedAvatar = Image::make($newAvatar['avatar'])->fit(125)->encode('jpg');

        // Current logged in user
        $user = auth()->user(); 

        // Old avatar filename (for deleting previous avatar)
        $oldFilename = str_replace('/storage/', 'public/', $user->avatar);

        // Set the file name of the new avatar
        $filename = $user->username . '_' . uniqid() . '.jpg';

        // Store the new avatar filename in the database
        $user->avatar = $filename;
        $user->save();

        // Store the new avatar in storage folder
        Storage::put('public/avatar/' . $filename, $resizedAvatar);

        // Delete the previous avatar
        if($oldFilename !== '/default-avatar.jpg') {
            Storage::delete($oldFilename);
        }

        return back()->with('success', 'Avatar changed');
    }

    // Search user
    public function searchUser($keyword) {
        // Search user according to the keyword
        $users = User::search($keyword)->get();

        return $users;
    }
}
