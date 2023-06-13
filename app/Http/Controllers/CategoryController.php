<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
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


    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($category) {
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'description' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');

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
