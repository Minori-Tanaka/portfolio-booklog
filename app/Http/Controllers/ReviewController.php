<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $review;
    private $book;
    private $user;
    private $category;

    public function __construct(Review $review, Book $book, User $user, Category $category)
    {
        $this->review = $review;
        $this->book = $book;
        $this->user = $user;
        $this->category = $category;
    }

    public function create($book_id) {
        $book = $this->book->findOrFail($book_id);
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('mypage.reviews.create')
            ->with('book', $book)
            ->with('user', $user);
    }

    public function store(Request $request, $book_id) {
        $request->validate([
            'content' => 'max:1000'
        ]);

        $this->review->user_id = Auth::user()->id;
        $this->review->book_id = $book_id;
        $this->review->rating = $request->rating;
        $this->review->content = $request->content;
        $this->review->status = $request->status;
        $this->review->save();
        
        if($request->category) {
            foreach($request->category as $category_id) {
                $category_book[] = [
                    'book_id' => $book_id,
                    'category_id' => $category_id,
                    'user_id' => Auth::user()->id
                ];
            }
            $this->book->find($book_id)->categoryBook()->createMany($category_book);
        }

        return redirect()->route('review.show', ['book_id' => $book_id, 'user_id' => Auth::user()->id]);
    }

    public function show($book_id, $user_id) {
        $book = $this->book->findOrFail($book_id);
        $user = $this->user->findOrFail($user_id);
        $review = $this->review
                        ->where('book_id', $book_id)
                        ->where('user_id', $user_id)
                        ->first();

        $selected_categories = [];
        foreach($user->categoryBook as $category_book) {
            if($category_book->book_id == $book->id){
                $selected_categories[] = $category_book->category_id;
            }
        }

        return view('mypage.reviews.show')
            ->with('book', $book)
            ->with('user', $user)
            ->with('review', $review)
            ->with('selected_categories', $selected_categories);
    }

    public function edit($book_id) {
        $book = $this->book->findOrFail($book_id);
        $user = $this->user->findOrFail(Auth::user()->id);
        $review = $this->review
                        ->where('book_id', $book_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
        

        $selected_categories = [];
        foreach($book->categoryBook as $category_book) {
            $selected_categories[] = $category_book->category_id;
        }

        return view('mypage.reviews.edit')
            ->with('book', $book)
            ->with('user', $user)
            ->with('review', $review)
            ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $book_id) {
        $request->validate([
            'content' => 'max:1000'
        ]);

        $review = $this->review
                        ->where('book_id', $book_id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
                        
        $review->rating = $request->rating;
        $review->content = $request->content;
        $review->status = $request->status;
        $review->save();
        
        $book = $this->book->findOrFail($book_id);
        $book->categoryBook()->where('user_id', Auth::user()->id)->delete();

        if($request->category) {
            foreach($request->category as $category_id) {
                $category_book[] = [
                    'book_id' => $book_id,
                    'category_id' => $category_id,
                    'user_id' => Auth::user()->id
                ];
            }
            $book->find($book_id)->categoryBook()->createMany($category_book);
        }

        return redirect()->route('review.show', ['book_id' => $book_id, 'user_id' => Auth::user()->id]);
    }

    public function destroy($book_id) {
        $this->review
            ->where('book_id', $book_id)
            ->where('user_id', Auth::user()->id)
            ->delete();
        
        return redirect()->back();
    }
}





