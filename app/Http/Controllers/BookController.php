<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $book;
    private $genre;

    public function __construct(Book $book, Genre $genre)
    {
        $this->book = $book;
        $this->genre = $genre;
    }

    public function index() {
        $allBooks = $this->book->get();

        return view('books.index')->with('allBooks', $allBooks);
    }

    public function create() {
        $allGenres = $this->genre->all();
        return view('books.create')->with('allGenres', $allGenres);
    }
}
