<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $articles = App\Models\Article::all();
    return view('welcome', compact('articles'));
});

Route::get('/admin/login', 'App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('admin.login');

Auth::routes();

Route::get('/admin', 'App\Http\Controllers\AdminController@index')->middleware(['auth', 'admin']);
Route::get('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [\App\Http\Controllers\Admin\AdminUserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->name('articles.index');
Route::get('/articles/create', 'App\Http\Controllers\ArticleController@create')->name('articles.create');
Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}/edit', 'App\Http\Controllers\ArticleController@edit')->name('articles.edit');
Route::put('/articles/{article}', 'App\Http\Controllers\ArticleController@update')->name('articles.update');


Route::resource('categories', 'App\Http\Controllers\CategoryController');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage');
