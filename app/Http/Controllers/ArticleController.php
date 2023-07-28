<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Import the DB facade


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        $approvedComments = [];

        // Fetch the approved comments for each article
        foreach ($articles as $article) {
            $approvedComments[$article->id] = $article->comments->where('status', 'approved');
        }

        return view('articles.index', compact('articles', 'categories', 'approvedComments'));
    }

    public function show(Article $article)
    {
        $categories = Category::all();
        $relatedArticles = [];

        // Fetch the related articles based on the category tag of the current article
        if ($article->category) {
            $relatedArticles = Article::whereHas('category', function ($query) use ($article) {
                $query->where('name', $article->category->name);
            })->where('id', '!=', $article->id)->take(5)->get();
        }

        // Fetch only the approved comments for the specific article
        $approvedComments = DB::table('comments')->where('article_id', $article->id)->where('status', 1)->get();

        return view('articles.article-details', compact('article', 'relatedArticles', 'approvedComments', 'categories'));
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

    public function showComments(Article $article)
    {
        return view('articles.comments', compact('article'));
    }
}
