@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="card">
        <div class="card-body">
            @forelse ($allBooks as $book)
                
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