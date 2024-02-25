<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index($id) {
        $user = $this->user->findOrFail($id);

        return view('mypage.index')->with('user', $user);
    }

    public function bookmark() {
        
    }
}
