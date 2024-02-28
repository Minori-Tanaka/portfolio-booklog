<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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
    Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/{id}/show', [BookController::class, 'show'])->name('book.show');
    Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::patch('/book/{id}/update', [BookController::class, 'update'])->name('book.update');

    // MY PAGE
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
    // BOOKMARK
    Route::post('/bookmark/{book_id}/store', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::get('/bookmark/{user_id}/show', [BookmarkController::class, 'show'])->name('bookmark.show');
    Route::delete('/bookmark/{book_id}/destroy', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    // PROFILE
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');
    // FOLLOW
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');
    // REVIEW
    Route::get('/review/{book_id}/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/{book_id}/store', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/{book_id}/{user_id}/show', [ReviewController::class, 'show'])->name('review.show');
    Route::get('/review/{book_id}/{user_id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::patch('/review/{book_id}/update', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{book_id}/destroy', [ReviewController::class, 'destroy'])->name('review.destroy');
    // CATEGORY
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
});
