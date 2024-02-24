@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <a href="{{route('book.create')}}" class="btn text-start btn-font" title="Add book" style="font-size: 2em">
        <i class="fa-solid fa-circle-plus"></i>
    </a>
    <div class="card p-5">
        @if ($allBooks->isNotEmpty())
            <div class="row justifi-content-center">
                @foreach ($allBooks as $book)
                    <div class="col-lg-2">
                        <div class="card bg-transparent">
                            <a href="{{route('book.show', $book->id)}}">
                                {{-- TODO? : bookmark -> badge --}}
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow w-100">
                            </a>
                            <div class="card-body ps-0 pt-2">
                                <a href="{{'book.show', $book->id}}" class="text-decoration-none text-dark">
                                    <h6 class="text-truncate mb-0">{{$book->title}}</h6>
                                </a>
                                {{-- TODO? : to author page --}}
                                <a href="#" class="text-decoration-none text-dark">
                                    <p class="small">{{$book->author}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center py-5">No Books Yet</h3>
        @endif        
    </div>
@endsection