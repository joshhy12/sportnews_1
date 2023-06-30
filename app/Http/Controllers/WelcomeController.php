<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class WelcomeController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $categories = Category::all();

          // Retrieve users
          $users = User::all();

        return view('welcome', compact('articles', 'categories'));
    }

}
