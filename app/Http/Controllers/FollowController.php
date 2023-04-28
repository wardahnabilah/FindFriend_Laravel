<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    // Store the follows
    public function storeFollow(User $user) {
        // Users can't follow themselves
        if($user->id === auth()->user()->id) {
            return back()->with('failed', "You can't follow yourself");
        }

        // User can't follow the same user more than once
        $alreadyFollowed = Follow::where([['user_id', '=', auth()->user()->id], ['follow_this_user', '=', $user->id]])->count();
        if($alreadyFollowed) {
            return back()->with('failed', "You've already followed this user");
        }
        
        // Store the id of the user who does the follow and the id of the user being followed
        Follow::create([
            'user_id' => auth()->user()->id,
            'follow_this_user' => $user->id
        ]);

        return back();
    }

    // Delete follow
    public function deleteFollow(User $user) {
        Follow::where([['user_id', '=', auth()->user()->id], ['follow_this_user', '=', $user->id]])->delete();

        return back()->with('success', 'Successfully Unfollowed');
    }
}
