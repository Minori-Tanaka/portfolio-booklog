@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <a href="{{route('book.create')}}" class="btn text-start" title="Add book" style="font-size: 2em">
        <i class="fa-solid fa-circle-plus"></i>
    </a>
    <div class="card">
        <div class="card-body">
            @if ($allBooks->isNotEmpty())
            
            @else
                <h3 class="text-muted text-center py-5">No Books Yet</h3>
            @endif
        </div>            
    </div>
@endsection