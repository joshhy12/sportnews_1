<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $articles = Article::all(); // Retrieve all articles from the database
        $categories = Category::all(); // Retrieve all categories from the database
        return view('admin.dashboard', compact('articles', 'categories'));
    }



    ///////////////////////////////////////////////////////////////////////////////////////
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

    public function updateUser(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            // other validation rules...
        ]);

        // Update the user's name
        $user->name = $request->input('name');

        // Check if the isAdmin checkbox is checked
        $isAdmin = $request->input('isAdmin') ? true : false;

        // Update the isAdmin field only if the user is authorized to do so
        if (auth()->user()->isAdmin) {
            $user->isAdmin = $isAdmin;
        }

        // Save the updated user
        $user->save();

        // Redirect to the appropriate page or show a success message
        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }




    public function storeUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
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
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
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





    /////////////////////////////////////////////////////////////////////////////////////////////

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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }


    public function editCategory(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }



    public function updateCategory(Request $request, Category $category)
    {
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        // Update any other attributes as needed

        $category->save();

        // Redirect to the categories index page or show success message
        if ($category) {
            return redirect()->route('admin.categories.index')->with('success', 'Category updates successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }



    public function showCategory(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }


    public function destroyCategory(Category $category)
    {
        $category->delete();
        // Redirect to the categories index page or show success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }



    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Articles
    public function manageArticle()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function showArticle(Article $article)
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

        return view('admin.articles.show', compact('article', 'relatedArticles', 'articles', 'categories'));
    }

    public function searchArticles(Request $request)
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

        return view('admin.articles.search', compact('articles', 'searchTitle', 'relatedArticles', 'categories'));
    }


    public function createArticle()
    {
        $categories = Category::all();
        $authors = User::all();
        return view('admin.articles.create', compact('categories', 'authors'));
    }





    public function editArticle($id)
    {
        $article = Article::find($id);
        $categories = Category::all();

        return view('admin.articles.edit', compact('article', 'categories'));
    }


    public function updateArticle(Request $request, $id)
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

        return redirect()->route('admin.articles.edit', $article->id)->with('success', 'Article updated successfully.');
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

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }




    ///////////////////////////////////////////////////////////////
    //Comment


    public function commentcreate()
    {
        $articles = Article::all();

        return view('comments.create', compact('articles'));
    }

    public function comment(Article $article, Request $request)
    {
        // Validate the comment data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        // Create a new comment
        $comment = new Comment();
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->content = $request->input('comment');
        $comment->approved = false; // Set the initial approval status to false

        // Associate the comment with the article
        $article->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added successfully! It is pending approval.');
    }

    public function showComments()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function approveComment(Comment $comment)
    {
        $comment->approved = true;
        $comment->save();

        return redirect()->route('admin.comments.index')->with('success', 'Comment approved successfully.');
    }
}
