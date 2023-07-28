<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController as Admin;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;


// Public routes accessible to all users

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Redirect authenticated users to the welcome page
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('welcome');
    })->name('dashboard');
});

///////////////////////////////Admin Penel//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Admin Penel
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'authorize'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User routes
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');


    // Category routes
    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.categories.index');
    Route::get('admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('admin/categories/{category}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::get('admin/categories/{category}', [AdminController::class, 'showCategory'])->name('admin.categories.show');
    Route::delete('admin/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');



    // Article routes
    Route::get('/admin/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');
    Route::get('/admin/articles', [AdminController::class, 'manageArticle'])->name('admin.articles.index');
    Route::get('/admin/articles/search', [AdminController::class, 'searchArticles'])->name('admin.articles.search');
    Route::get('/admin/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.createForm');
    Route::post('/admin/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::get('/admin/articles/{article}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::put('/admin/articles/{article}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::get('/admin/articles/{article}', [AdminController::class, 'showArticle'])->name('admin.articles.show');
    //  Route::get('/admin/articles/{id}', [AdminController::class, 'showArticle'])->name('admin.articles.show');
    Route::delete('/admin/articles/{article}', [AdminController::class, 'destroyArticle'])->name('admin.articles.destroy');


    // comment

    Route::post('/admin/comments/{comment}/approve', [CommentController::class, 'approveComment'])->name('admin.comments.approve');
   // Route::get('/admin/comments/approved', [CommentController::class, 'approved'])->name('admin.comments.approved');

    Route::get('/admin/comments/approved', [AdminController::class, 'approved'])->name('admin.comments.approved');


    Route::post('/admin/comments', [AdminController::class, 'store'])->name('admin.comments.store');
    Route::get('/admin/comments', [AdminController::class, 'showComments'])->name('admin.comments.index');
    Route::post('/admin/comments/{comment}/approve', [AdminController::class, 'approveComment'])->name('admin.comments.approve');
    Route::get('comments', [AdminController::class, 'index'])->name('admin.comments.index');
    Route::put('comments/{id}/approve', [AdminController::class, 'approveComment'])->name('admin.comments.approve');
    Route::put('comments/{id}/deny', [AdminController::class, 'denyComment'])->name('admin.comments.deny');
    Route::delete('comments/{id}', [AdminController::class, 'deleteComment'])->name('admin.comments.delete');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//////////////////////////////Users//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Articles
//Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
//Route::get('/articles/{article}/comments', [ArticleController::class, 'showComments'])->name('articles.comments');



// Categories
Route::get('/', [CategoryController::class, 'index'])->name('home');
Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Comment Routes
Route::post('/comments', [CommentController::class, 'storeComment'])->name('comments.store');
Route::post('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
Route::post('/comments/add', [CommentController::class, 'addComment'])->name('comments.add');


//About
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::post('/submit-form', 'ContactController@submit')->name('contact.submit');


//contact
Route::post('/contact/submit', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');

// Route for displaying the contact form
Route::get('/contact', function () {
    return view('contact');
});
// Route for handling the form submission
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

//User
Auth::routes();
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/update', [UserController::class, 'update'])->name('users.update');

// Authentication Routes
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
