<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Postcontroller extends Controller
{


        public function index(){
        return redirect('/home');
        }

    public function deletePost(Post $post)
    {
        // Check if the currently authenticated user is the owner of the post
        if (auth()->user()->id === $post->user_id) {
            $post->delete();
        }
        return redirect('/')->with('status', 'Post Deleted Successfully');
    }

    public function actuallyUpdatePost(Request $request, $id)
    {
        // Fetch the existing post by its ID
        $post = Post::findOrFail($id);

        // Check if the currently authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }


        // Validate the incoming request fields
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        // Update the post with the validated fields
        $post->update([
            'title' => $incomingFields['title'],
            'body' => $incomingFields['body']
        ]);

        // Redirect the user to the homepage
        return redirect('/')->with('status', 'Updated Successfully');
    }
    public function showEditScreens(Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }


        return view('edit-post', ['post' => $post]);
    }



    public function createPost(Request $request)
    {
        if (Auth::check()) {
            $incomingFields = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);
            $incomingFields['title'] = strip_tags($incomingFields['title']);
            $incomingFields['body'] = strip_tags($incomingFields['body']);
            $incomingFields['user_id'] = auth()->id();

            Post::create($incomingFields);
            return redirect('/')->with('status', 'Post Uploaded Sucessfully');
        } else {
            return redirect('/login')->with('status', 'You are not logged in');
        }
    }

}
