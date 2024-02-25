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

    public function index() {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('mypage.index')
            ->with('user', $user);
    }
}
