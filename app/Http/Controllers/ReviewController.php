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

    private function getFinishedBooks($user_id) {
        $reviews_finished = $this->review->where('user_id', $user_id)->where('status', 'Finished')->get();
        $finished_books = [];
        foreach($reviews_finished as $review) {
            $finished_books[] = $review->book()->first();
        }

        $finished_books = collect($finished_books)->reverse();

        return $finished_books;
    }

    private function getReadingBooks($user_id) {
        $reviews_reading = $this->review->where('user_id', $user_id)->where('status', 'Reading')->get();
        $reading_books = [];
        foreach($reviews_reading as $review) {
            $reading_books[] = $review->book()->first();
        }

        $reading_books = collect($reading_books)->reverse();

        return $reading_books;
    }

    private function getWantBooks($user_id) {
        $reviews_want = $this->review->where('user_id', $user_id)->where('status', 'Want')->get();
        $want_books = [];
        foreach($reviews_want as $review) {
            $want_books[] = $review->book()->first();
        }

        $want_books = collect($want_books)->reverse();

        return $want_books;
    }

    private function getUnsetBooks($user_id) {
        $reviews_unset = $this->review->where('user_id', $user_id)->where('status', 'Unset')->get();
    
        $unset_books = [];
        foreach($reviews_unset as $review) {
            $unset_books[] = $review->book()->first();
        }

        $unset_books = collect($unset_books)->reverse();

        return $unset_books;   
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

    public function status($user_id) {
        $user = $this->user->findOrFail($user_id);
        $finished_books = $this->getFinishedBooks($user_id);
        $reading_books = $this->getReadingBooks($user_id);
        $want_books = $this->getWantBooks($user_id);
        $unset_books = $this->getUnsetBooks($user_id);

        return view('mypage.reviews.status')
            ->with('user', $user)
            ->with('finished_books', $finished_books)
            ->with('reading_books', $reading_books)
            ->with('want_books', $want_books)
            ->with('unset_books', $unset_books);
    }
}





