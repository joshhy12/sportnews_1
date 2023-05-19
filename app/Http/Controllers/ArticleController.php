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
        return view('articles.index', compact('articles'));
    }


    public function test()
    {
        return view('articles.test');
    }



    public function create()
    {
        $categories = Category::all();
        $authors = User::all();
        return view('articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');
    //    $article->author_id = auth()->user()->id; // Set the current user's ID as the author ID
        $article->published_at = $request->input('published_at');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $article->image_url = $imagePath;
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }


    public function edit($id)
{
    $article = Article::findOrFail($id);
    $categories = Category::all(); // Fetch all categories

    return view('articles.edit', compact('article', 'categories'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',

    ]);

    $article = Article::findOrFail($id);
    $article->title = $request->input('title');
    $article->content = $request->input('content');
    $article->category_id = $request->input('category_id');
    $article->save();

    return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
}

public function show($id)
{
    $article = Article::findOrFail($id);
    return view('articles.article-details', compact('article'));
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
