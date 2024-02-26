<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    // BOOK
    Route::get('/book', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{id}/show', [BookController::class, 'show'])->name('book.show');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');

    // MY PAGE
    Route::get('mypage/{id}/index', [MypageController::class, 'index'])->name('mypage.index');
        // BOOKMARK
        Route::post('bookmark/{book_id}/store', [BookmarkController::class, 'store'])->name('bookmark.store');
        Route::get('bookmark/{id}/show', [BookmarkController::class, 'show'])->name('bookmark.show');
        // PROFILE
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
        Route::get('profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');
        // FOLLOW
        Route::post('follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
        Route::delete('follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
});
