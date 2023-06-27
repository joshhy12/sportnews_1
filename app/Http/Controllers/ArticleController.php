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
        $articles = Article::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::all();
        return view('articles.article-details', compact('article', 'articles', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation rules
        ]);

        // Update the article data
        $article->title = $validatedData['title'];
        $article->content = $validatedData['content'];
        $article->category_id = $validatedData['category_id'];
        $article->published_at = $validatedData['published_at'];

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('article_images', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('articles.show', $article->id)->with('success', 'Article updated successfully.');
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

        return view('articles.article-details', compact('article', 'relatedArticles', 'articles', 'relatedArticles','categories' ));
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
