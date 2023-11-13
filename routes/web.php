<?php

use App\Events\MessageSent;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeaturedPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostModerationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/dashboard/category', CategoryController::class)->names('category');
    Route::resource('admin/dashboard/post', AdminPostController::class)->names('admin.post');
    Route::get('admin/dashboard/moderation', [PostModerationController::class, 'index'])->name('admin.moderation');
    Route::get('admin/dashboard/moderation/accept/{post}', [PostModerationController::class, 'accept'])->name('admin.moderation.accept');
    Route::get('admin/dashboard/moderation/reject/{post}', [PostModerationController::class, 'reject'])->name('admin.moderation.reject');
    Route::get('admin/dashboard/featuredPost', [FeaturedPostController::class, 'index'])->name('admin.featuredPost');
    Route::get('admin/dashboard/featuredPost/add/{post}', [FeaturedPostController::class, 'addToFeatured'])->name('admin.featuredPost.add');
    Route::get('admin/dashboard/featuredPost/remove/{post}', [FeaturedPostController::class, 'removeFromFeatured'])->name('admin.featuredPost.remove');

    Route::resource('admin/dashboard/user', UserController::class)->names('user');
});

// Post
Route::middleware('auth')->group(function(){
    Route::get('post/create', [PostController::class, 'create'])->name('post.create'); 
    Route::post('post', [PostController::class, 'store'])->name('post.store'); 
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit'); 
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});
Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');

// Comment
Route::get('post/comment/fetchAll', [CommentController::class, 'fetchAll'])->name('fetchAllComment');
Route::post('post/comment/add', [CommentController::class,'store'])->name('comment.store');
Route::post('post/comment/update', [CommentController::class,'update'])->name('comment.update');
Route::post('post/comment/delete', [CommentController::class,'destroy'])->name('comment.destroy');
Route::post('post/comment/reply', [CommentController::class, 'reply'])->name('comment.reply');

Route::middleware('auth')->group(function(){
    Route::get('chat', [ChatController::class,'showChat'])->name('chat');
    Route::post('chat/message', [ChatController::class,'messageReceived'])->name('chat.message');
});

Route::get('notdone', [CategoryController::class,'notdone'])->name('notdone');


