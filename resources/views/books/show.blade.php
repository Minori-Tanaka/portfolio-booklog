@extends('layouts.app')

@section('title', $book->title)

@section('sidebar')
    @include('books.sidebar')
@endsection

@section('content')
    <div class="card p-5 mt-5">
        <div class="card bg-white shadow mb-5">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-3 pe-3">
                        @if ($book->cover_photo)
                            <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="shadow w-100">
                            {{-- TODO? : to genre page --}}
                            <a href="#" class="badge bg-secondary text-decoration-none bg-opacity-50 mt-2">
                                {{$book->genre->name}}
                            </a>
                        @else
                            <i class="fa-solid fa-image fa-10x text-secondary"></i>
                        @endif
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <h3>{{$book->title}}</h3>
                            
                        </div>
                        {{-- TODO? : to author page --}}
                        <p class="text-muted fw-bold mb-2">by {{$book->author}}</p>
                        <p class="text-muted">Published in {{$book->published_year}}</p>
                        <div class="d-flex">
                            @if ($book->isBookmarked())
                                {{-- TODO : if already bookmark -> check mark, review ditail --}}
                                <a href="#" class="btn btn-secondary">
                                    <i class="fa-regular fa-circle-check me-1"></i> Saved
                                </a>
                            @else
                                <form action="{{route('bookmark.store', $book->id)}}" method="post" class="my-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa-solid fa-bookmark me-1"></i> Bookmark
                                    </button>
                                </form>
                            @endif
                            
                            @if ($book->user->id === Auth::user()->id)
                                <a href="{{route('book.edit', $book->id)}}" class="btn btn-outline-dark ms-4" title="Edit Book">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                </a>
                            @endif
                        </div>
                        <hr>
                        <p>{{$book->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- TODO : Review --}}
        <div class="card bg-white">
            <h3>Reviews</h3>
        </div>
    </div>
@endsection