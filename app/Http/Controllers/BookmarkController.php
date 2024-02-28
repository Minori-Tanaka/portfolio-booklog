<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    private $bookmark;
    private $user;
    private $review;

    public function __construct(Bookmark $bookmark, User $user, Review $review)
    {
        $this->bookmark = $bookmark;
        $this->user = $user;
        $this->review = $review;
    }

    public function store($book_id) {
        $this->bookmark->user_id = Auth::user()->id;
        $this->bookmark->book_id = $book_id;
        $this->bookmark->save();

        return redirect()->back();
    }

    public function show($user_id) {
        $user = $this->user->findOrFail($user_id);

        return view('mypage.bookmarks.show')
            ->with('user', $user);
    }

    public function destroy($book_id) {
        $this->bookmark
            ->where('user_id', Auth::user()->id)
            ->where('book_id', $book_id)
            ->delete();

        return redirect()->back();
    }
}
