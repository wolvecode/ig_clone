<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\PostController;

//HomePage
Route::get('/', function (){
    return view('home');
})->name('home');

//Dashboard when user is login
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard');

//Login Page
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);

//Logout
Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])
    ->name('logout');

//Register page
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index'])
    ->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);

//Posts
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])
    ->name('posts');
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'post']);
Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'delete'])
    ->name('post.delete');


//Like
Route::post('/posts/{post}/like', [\App\Http\Controllers\PostLikeController::class, 'like'])
    ->name('post.like');
//Unlike a post
Route::delete('/posts/{post}/unlike', [\App\Http\Controllers\PostLikeController::class, 'unlike'])
    ->name('post.unlike');

