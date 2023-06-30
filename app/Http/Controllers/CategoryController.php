<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $categories = Category::all(); // Fetch the categories from your database or any other source

        return view('home', compact('articles', 'categories'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $categories = Category::where('name', 'like', "%$query%")
                ->get();
        } else {
            $categories = collect(); // Empty collection when query is empty
        }

        return view('categories.search', compact('categories', 'query'));
    }

    public function show(Category $category)
    {
        // Retrieve the category details and any related data you need
        $category = $category->load('articles'); // Assuming you have a relationship named 'articles' in your Category model

        // Retrieve the articles for the category
        $articles = $category->articles;

        // Retrieve all categories
        $categories = Category::all();

        // Pass the category, articles, and categories data to the view
        return view('categories.show', compact('category', 'articles', 'categories'));
    }
}
