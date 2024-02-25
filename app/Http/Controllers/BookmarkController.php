<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    private $bookmark;
    private $user;

    public function __construct(Bookmark $bookmark, User $user)
    {
        $this->bookmark = $bookmark;
        $this->user = $user;
    }

    public function store($book_id) {
        $this->bookmark->user_id = Auth::user()->id;
        $this->bookmark->book_id = $book_id;
        $this->bookmark->save();

        return redirect()->back();
    }

    public function show() {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('mypage.contents.bookmark')
            ->with('user', $user);
    }
}
