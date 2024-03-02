<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    private $user;
    private $book;

    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    private function getSuggestedBooks() {
        $all_books = $this->book->latest()->get();
        $suggested_books = [];

        foreach($all_books as $book) {
            if(!$book->isBookmarked()) {
                $suggested_books[] = $book;
            }
        }

        return array_slice($suggested_books, 0, 6);
    }

    private function getSuggestedUsers() {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user) {
            if(!$user->isFollowed()) {
                $suggested_users[] = $user;
            }
        }

        return array_slice($suggested_users, 0, 10);
    }

    public function index() {
        $user = $this->user->findOrFail(Auth::user()->id);
        $suggested_books = $this->getSuggestedBooks();
        $suggested_users = $this->getSuggestedUsers();

        if(Auth::user()->id != $user->id) {
            return redirect()->route('mypage.bookmark.show', $user->id);
        }

        return view('mypage.index')
            ->with('user', $user)
            ->with('suggested_books', $suggested_books)
            ->with('suggested_users', $suggested_users);
    }
}
