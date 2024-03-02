@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="card p-5 mt-5">
        <h3>Registration</h3>
        <div class="row mb-5">
            <div class="col">
                <div class="card bg-light text-center p-3">
                    <a href="{{route('book.index')}}" class="text-decoration-none text-dark display-6">
                        <i class="fa-solid fa-book me-2"></i> <strong>{{$allBooks->count()}}</strong>
                    </a>
                    <p class="h1 text-secondary mb-0 mt-2">Books</p>
                </div>
            </div>
            <div class="col">
                <div class="card bg-light text-center p-3">
                    <a href="{{route('author.index')}}" class="text-decoration-none text-dark display-6">
                        <i class="fa-solid fa-pen-nib me-2"></i> <strong>10</strong>
                    </a>
                    <p class="h1 text-secondary mb-0 mt-2">Authors</p>
                </div>
            </div>
            <div class="col">
                <div class="card bg-light text-center p-3">
                    <a href="{{route('book.index')}}" class="text-decoration-none text-dark display-6">
                        <i class="fa-solid fa-users me-2"></i> <strong>{{$allUsers->count()}}</strong>
                    </a>
                    <p class="h1 text-secondary mb-0 mt-2">Users</p>
                </div>
            </div>
        </div>
        <h4>Recent Books</h4>
        @if ($allBooks->isNotEmpty())
            <div class="row justifi-content-center">
                @foreach ($allBooks->take(5) as $book)
                    <div class="card p-0 m-3" style="width: 146px">
                        <a href="{{route('book.show', $book->id)}}" class="position-relative">
                            <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-md">
                        </a>
                        <div class="card-body py-2 px-0">
                            <a href="{{'book.show', $book->id}}" class="text-decoration-none text-dark">
                                <h6 class="card-title mb-0">{{$book->title}}</h6>
                            </a>
                            {{-- TODO? : to author page --}}
                            <a href="#" class="text-decoration-none text-dark">
                                <p class="small text-truncate my-1">{{$book->author}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center py-5">No Books Yet</h3>
        @endif        
    </div>
@endsection