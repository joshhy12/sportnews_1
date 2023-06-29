<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function addComment(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'article_id' => 'required',
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'article_id' => $request->article_id,
        ]);

        // Check if the user is logged in
        if (auth()->check()) {
            // If logged in, associate the comment with the logged-in user
            $comment->user_id = auth()->user()->id;
            $comment->username = auth()->user()->name; // Set the username from the logged-in user
        } else {
            // If not logged in, set the username from the form input
            $comment->username = $request->username;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


}
