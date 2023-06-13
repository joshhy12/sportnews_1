<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController as Admin;
use App\Http\Controllers\WelcomeController;

// Public routes accessible to all users

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/categories', [AdminController::class, 'manageCategories'])->name('admin.categories.index');
    // Add routes for creating, editing, updating, and deleting categories

    //Route::get('/admin/articles', [AdminController::class, 'manageArticles'])->name('admin.articles.index');
    Route::get('admin/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('admin/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('admin/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

    Route::put('admin/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get('admin/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::delete('admin/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});
    // Add routes for creating, editing, updating, and deleting articles

    // Add routes for other admin actions
// Add routes for other admin actions
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.editForm');


Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');


// Other routes...
Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');


// Categories
Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


//home
Route::get('/home', [HomeController::class, 'index'])->name('home');


//comment
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('/comments', [CommentController::class, 'addComment'])->name('comments.add');

//About
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
