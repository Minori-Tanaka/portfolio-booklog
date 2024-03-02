<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $category;
    private $user;

    public function __construct(Category $category, User $user)
    {
        $this->category = $category;
        $this->user = $user;
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $this->category->name = $request->name;
        $this->category->user_id = Auth::user()->id;
        $this->category->save();

        return redirect()->back();
    }

    public function show($user_id) {
        $user = $this->user->findOrFail($user_id);

        return view('mypage.categories.show')
                ->with('user', $user);
    }
}
