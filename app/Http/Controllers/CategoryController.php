<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
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
}
