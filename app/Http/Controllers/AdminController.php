<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }


    public function dashboard()
    {
        $articles = Article::all(); // Retrieve all articles from the database
        $categories = Category::all(); // Retrieve all categories from the database
        return view('admin.dashboard',compact('articles', 'categories'));
    }

    //Users
    public function manageUsers()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        // Logic for creating a user
        return view('admin.users.create');

    }

    public function editUser($id)
{
    $user = User::find($id);
    // Logic for editing a user
    return view('admin.users.edit', compact('user'));
}

public function destroyUser($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
        // Logic for successful deletion
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    } else {
        // Logic for user not found
        return redirect()->route('admin.users.index')->with('error', 'User not found.');
    }
}

public function storeUser(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Create a new user record
    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    // Set any other relevant user properties

    // Save the user record
    $user->save();

    // Redirect to a relevant page or return a response
    // For example, redirect to the user index page
    return redirect()->route('admin.users.index');
}


//Category




public function manageCategories()
{
    $categories = Category::all();
    return view('admin.categories.index', ['categories' => $categories]);
}

public function createCategory()
{
    return view('admin.categories.create');
}

public function storeCategory(Request $request)
{
    $category = new Category();
    $category->name = $request->input('name');
    // Add any other attributes you want to save

    $category->save();

    // Redirect to the categories index page or show success message
    return redirect()->route('admin.categories.index');
}

public function editCategory(Category $category)
{
    return view('admin.categories.edit', ['category' => $category]);
}

public function updateCategory(Request $request, Category $category)
{
    $category->name = $request->input('name');
    // Update any other attributes as needed

    $category->save();

    // Redirect to the categories index page or show success message
    return redirect()->route('admin.categories.index');
}

public function showCategory(Category $category)
{
    return view('admin.categories.show', ['category' => $category]);
}

public function destroyCategory(Category $category)
{
    $category->delete();

    // Redirect to the categories index page or show success message
    return redirect()->route('admin.categories.index');
}




//Articles
public function manageArticles()
{
    $articles = Article::all();

    return view('admin.articles.index', compact('articles'));
}

public function createArticle()
{
    return view('admin.articles.create');
}

public function editArticle($id)
{
    $article = Article::find($id);

    return view('admin.articles.edit', compact('article'));
}

public function destroyArticle($id)
{
    $article = Article::find($id);

    if ($article) {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    } else {
        return redirect()->route('admin.articles.index')->with('error', 'Article not found.');
    }
}

public function storeArticle(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    $article = new Article();
    $article->title = $request->input('title');
    $article->content = $request->input('content');
    // Set any other relevant article properties

    $article->save();

    return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
}








}
