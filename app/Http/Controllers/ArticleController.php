<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {

        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::all();
        // Fetch the related articles based on the category tag of the current article
        if ($article->category) {
            $relatedArticles = Article::whereHas('category', function ($query) use ($article) {
                $query->where('name', $article->category->name);
            })->where('id', '!=', $article->id)->take(5)->get();
        } else {
            $relatedArticles = [];
        }

        return view('articles.article-details', compact('article', 'relatedArticles', 'articles', 'relatedArticles', 'categories'));
    }



    public function search(Request $request)
    {
        $categories = Category::all();
        $searchTitle = $request->input('searchtitle');

        $articles = Article::where('title', 'like', '%' . $searchTitle . '%')->get();

        $relatedArticles = [];

        if ($articles->count() > 0) {
            $article = $articles->first();

            if ($article->category) {
                $relatedArticles = Article::whereHas('category', function ($query) use ($article) {
                    $query->where('name', $article->category->name);
                })->where('id', '!=', $article->id)->take(5)->get();
            }
        }

        return view('articles.search', compact('articles', 'searchTitle', 'relatedArticles', 'categories'));
    }



    public function addComment(Request $request, Article $article)
    {
        $request->validate([
            'username' => 'required',
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->username = $request->input('username');
        $comment->content = $request->input('content');
        $comment->article_id = $article->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }


    public function storeComment(Request $request, Article $article)
    {
        $request->validate([
            'username' => 'required',
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->username = $request->input('username');
        $comment->content = $request->input('content');
        $comment->article_id = $article->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
