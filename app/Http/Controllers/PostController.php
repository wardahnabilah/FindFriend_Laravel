<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Show create post form
    public function showPostForm() {
        return view('create-post');
    }

    // Store new post
    public function storeNewPost(Request $requesttt) {
        $newPost = $requesttt->validate([
            'postTitle' => 'required',
            'postBody' => 'required'
        ]);

        // Remove any tags in the title and body input if exists
        $newPost['postTitle'] = strip_tags($newPost['postTitle']);
        $newPost['postBody'] = strip_tags($newPost['postBody']);
        
        // Set user_id to the current login user's id
        $newPost['user_id'] = auth()->user()->id;

        // Store new post data in the database
        $post = Post::create([
            'title' => $newPost['postTitle'], 
            'body' => $newPost['postBody'],
            'user_id' => $newPost['user_id']
        ]);

        return redirect("/post/{$post->id}")->with('success', 'New post created');
    }

    // Show the post
    public function showThePost(Post $post) {

        // Markdown support
        $post->title = strip_tags(Str::markdown($post->title), '<strong><em><u>');
        $post->body = Str::markdown($post->body);
        
        return view('post', [
            'post' => $post,
            'title' => $post ->title, 
            'body' => $post->body, 
            'created_at' => $post->created_at,
            'author' => $post->author->username
        ]);
    }

    // Delete the post
    public function deletePost(Post $post) {
        // Only the author of the post can delete the post
        if(auth()->user()->can('delete', $post)) {
            $post->delete();
            
            return redirect('/profile/' . auth()->user()->username)->with('success', 'Post Deleted');
        } else {
            return redirect('/profile/' . auth()->user()->username)->with('failed', "You can't delete the post");
        }
    }
}