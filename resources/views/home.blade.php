@extends('layouts.app')

@section('title', 'Home')

@section('sidebar')
    <ul class="nav nav-pills flex-column bg-light mt-5">
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link active bg-secondary">
                <i class="fa-solid fa-house me-2"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('book.index')}}" class="nav-link text-dark">
                <i class="fa-solid fa-book me-2"></i> Book List
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('mypage.index', Auth::user()->id)}}" class="nav-link text-dark">
                <i class="fa-solid fa-user me-2"></i> My Page
            </a>
        </li>                       
    </ul>
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            @forelse ($allBooks as $book)
                <p>{{$book->title}}</p>
            @empty
                <div class="text-center py-5">
                    <h2>Share Books</h2>
                    <p class="text-muted">When you share books, they'll appear on your page.</p>
                    <a href="{{route('book.create')}}">Share your first book</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection