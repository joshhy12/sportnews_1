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
            'article_id' => 'required|exists:articles,id',
            'username' => 'required',
            'content' => 'required',
        ]);

        $comment = Comment::create([
            'article_id' => $request->input('article_id'),
            'username' => $request->input('username'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
