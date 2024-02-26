<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index($id) {
        $user = $this->user->findOrFail($id);

        if(Auth::user()->id != $user->id) {
            return redirect()->route('bookmark.show', $user->id);
        }

        return view('mypage.index')
            ->with('user', $user);
    }
}
