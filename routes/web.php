<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::name('login.')->group(function () {
            Route::get('/login',[AuthController::class,'loginPage'])->name('page');
            Route::post('/login',[AuthController::class,'loginUser'])->name('handler');
        });
        Route::name('register.')->group(function () {
            Route::get('/register',[AuthController::class,'registerPage'])->name('page');
            Route::post('/register',[AuthController::class,'registerUser'])->name('handler');
        });
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout',[AuthController::class,'logoutUser'])->name('logout');
    });
});

Route::name('user.')->group(function () {
    Route::get('/',[CommentController::class,'getAllProfiles'])->name('profiles');
    Route::get('/profile/{user:id}',[CommentController::class,'profilePage'])->name('profile');

    Route::middleware('auth')->prefix('profile')->group(function () {
        Route::get('/{user:id}/comments',[CommentController::class,'getUserComments'])->name('comments');
        Route::post('/add-comment',[CommentController::class,'addComment'])->name('comment.add');
        Route::post('/delete-comment',[CommentController::class,'deleteComment'])->name('comment.delete');

        Route::get('/{user:id}/books',[BookController::class,'index'])->name('books');
        Route::get('/{user:id}/book/create',[BookController::class,'create'])->name('book.create');
        Route::post('/{user:id}/book/store',[BookController::class,'create'])->name('book.store');
        Route::get('/{user:id}/book/{book:id}',[BookController::class,'show'])->name('book.show');
        Route::put('/{user:id}/book/{book:id}',[BookController::class,'update'])->name('book.update');
        Route::delete('/{user:id}/book/{book:id}',[BookController::class,'delete'])->name('book.delete');
    });
});
