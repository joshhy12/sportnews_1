<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;



class CommentController extends Controller
{



    public function store(Request $request, Article $article)
    {
        $request->validate([
            'content' => 'required',
            'article_id' => 'required',
        ]);

        $comment = new Comment([
            'content' => $request->input('content'),
        ]);

        $comment->user_id = auth()->user()->id;
        $comment->article_id = $article->id;
        $comment->save();

        return back()->with('success', 'Comment submitted. Please wait for admin approval.');
    }

    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->approved = true;
        $comment->save();

        return back()->with('success', 'Comment approved successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

    public function add(Request $request)
    {
        // Validate the comment data
        $validatedData = $request->validate([
            'username' => 'required',
            'content' => 'required',
            'article_id' => 'required',
        ]);

        // Create a new comment instance
        $comment = new Comment();
        $comment->user_id = auth()->user()->id; // Assuming you have authentication and want to associate the comment with the authenticated user
        $comment->article_id = $request->input('article_id'); // Assuming you have the article_id available in the request
        $comment->content = $validatedData['content'];
        // Other properties of the comment, if any

        // Save the comment
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully. Waiting for admin approval.');
    }
}
