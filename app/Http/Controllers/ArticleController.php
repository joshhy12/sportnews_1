<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
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
        $query = $request->input('query');

        if ($query) {
            $articles = Article::whereHas('category', function ($categoryQuery) use ($query) {
                $categoryQuery->where('name', 'like', "%$query%");
            })
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $articles = collect(); // Empty collection when query is empty
        }

        return view('articles.search', compact('articles', 'query'));
    }
}
