<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    private $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }
}
