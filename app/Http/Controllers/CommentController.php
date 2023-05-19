<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required',
            'article_id' => 'required',
            'username' => 'required',
        ]);

        Comment::create([
            'username' => $request->username,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment created successfully.');
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }


    public function addComment(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'content' => 'required',
        ]);

        $comment = new Comment([
            'content' => $request->content,
        ]);

        // Check if the user is logged in
        if (auth()->check()) {
            // If logged in, associate the comment with the logged-in user
            $comment->user_id = auth()->user()->id;
        } else {
            // If not logged in, set the username from the form input
            $comment->username = $request->username;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


}
