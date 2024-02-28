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

        return array_slice($suggested_books, 0, 8);
    }

    public function index() {
        $user = $this->user->findOrFail(Auth::user()->id);
        $suggested_books = $this->getSuggestedBooks();

        if(Auth::user()->id != $user->id) {
            return redirect()->route('mypage.bookmark.show', $user->id);
        }

        return view('mypage.index')
            ->with('user', $user)
            ->with('suggested_books', $suggested_books);
    }
}
