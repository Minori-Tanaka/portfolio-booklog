<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookmark;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private $book;
    private $genre;

    public function __construct(Book $book, Genre $genre, Bookmark $bookmark)
    {
        $this->book = $book;
        $this->genre = $genre;
    }

    public function index() {
        $allBooks = $this->book->get();

        return view('books.index')
            ->with('allBooks', $allBooks);
    }

    public function create() {
        $allGenres = $this->genre->all();
        return view('books.create')->with('allGenres', $allGenres);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'published_year' =>'required|integer',
            'cover_phpto' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'genre_id' => 'required',
            'description' => 'required|max:1000'
        ]);

        $this->book->title = $request->title;
        $this->book->author = $request->author;
        $this->book->published_year = $request->published_year;
        $this->book->cover_photo = 'data:image/' . $request->cover_photo->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_photo));
        $this->book->genre_id = $request->genre_id;
        $this->book->description = $request->description;
        $this->book->user_id = Auth::user()->id;
        $this->book->save();

        return redirect()->route('book.index');
    }

    public function show($id) {
        $book = $this->book->findOrFail($id);

        return view('books.show')->with('book', $book);
    }

    public function edit($id) {
        $book = $this->book->findOrFail($id);
        $allGenres = $this->genre->all();

        if(Auth::user()->id != $book->user->id) {
            return redirect()->route('book.index');
        }

        return view('books.edit')
            ->with('book', $book)
            ->with('allGenres', $allGenres);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'published_year' =>'required|integer',
            'cover_phpto' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'genre_id' => 'required',
            'description' => 'required|max:1000'
        ]);

        $book = $this->book->findOrFail($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->genre_id = $request->genre_id;
        $book->description = $request->description;
        $book->user_id = Auth::user()->id;

        if($request->cover_photo) {
            $book->cover_photo = 'data:image/' . $request->cover_photo->extension() . ';base64,' . base64_encode(file_get_contents($request->cover_photo));
        }
        
        $book->save();

        return redirect()->route('book.show', $book->id);
    }
}
