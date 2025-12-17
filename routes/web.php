<?php

use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

use App\Models\User;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/Blogpost', function () {
    $posts = Post::latest()->paginate(20);
    return view('Blogpost', compact('posts'));
});

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::get('/posts/{post}', function (Post $post) {
    return view('Blogpost', compact('post'));
})->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', function () {
    $posts = Post::count();
    $users = User::count();
    $categories = Category::all();
    return view('dashboard', compact('posts', 'users', 'categories'));
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(IsAdminMiddleware::class)->group(function () { 
        Route::resource('categories', CategoryController::class); 
        Route::resource('posts', PostController::class);
});
});

require __DIR__.'/auth.php';
