@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="card p-5">
        <div class="card bg-white shadow mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        @if ($book->cover_photo)
                            <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="w-100">
                            {{-- TODO? : to genre page --}}
                            <a href="#">
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{$book->genre->name}}
                                </div>
                            </a>
                        @else
                            <i class="fa-solid fa-image fa-10x text-secondary"></i>
                        @endif
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <h3>{{$book->title}}</h3>
                            @if ($book->user->id === Auth::user()->id)
                                <a href="{{route('book.edit', $book->id)}}" class="btn btn-font p-0" title="Edit Book">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @endif
                        </div>
                        {{-- TODO? : to author page --}}
                        <p class="text-muted fw-bold mb-2">by {{$book->author}}</p>
                        <p class="text-muted">Published in {{$book->published_year}}</p>
                        {{-- TODO : add to bookshelf --}}
                        <form action="#" method="post">
                            @csrf
                            {{-- TODO : if not bookmark -> --}}
                            <button type="submit" class="btn btn-dark">
                                <i class="fa-solid fa-plus"></i> Add to Bookshelf
                            </button>
                            {{-- TODO : if already bookmark -> check mark, review ditail --}}
                        </form>
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