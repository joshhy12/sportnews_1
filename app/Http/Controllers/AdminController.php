<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Article CRUD methods
    public function indexArticles()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function storeArticle(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:articles',
        ]);

        $article = new Article($validatedData);

        // Upload image file if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully!');
    }

    public function editArticle(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|unique:articles,slug,'.$article->id,
        ]);

        $article->category_id = $validatedData['category_id'];
        $article->title = $validatedData['title'];
        $article->body = $validatedData['body'];

        // Update image file if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroyArticle(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }


    // Category CRUD methods
    public function indexCategories()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:categories',
        ]);

        $category = new Category($validatedData);
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', compact('categories'));
    }

        public function updateCategory(Request $request, Category $category)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
                'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
            ]);

            $category->name = $validatedData['name'];
            $category->slug = $validatedData['slug'];
            $category->save();

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        }

        public function deleteCategory(Category $category)
        {
            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
        }
    }
