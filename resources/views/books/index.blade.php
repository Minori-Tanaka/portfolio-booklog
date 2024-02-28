@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <div class="d-flex justify-content-end my-2">
        <a href="{{route('book.create')}}" class="btn btn-dark" title="Add book">
            <i class="fa-solid fa-circle-plus"></i> Add Book
        </a>
    </div>
    <div class="card p-5">
        @if ($allBooks->isNotEmpty())
            <div class="row justifi-content-center">
                @foreach ($allBooks as $book)
                    <div class="card p-0 m-3" style="width: 146px">
                        <a href="{{route('book.show', $book->id)}}" class="position-relative">
                            <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-md">
                            @if ($book->isBookmarked())
                                <span class="position-absolute top-0 end-0 p-0 badge text-warning" style="font-size: 1.8em">
                                    <i class="fa-solid fa-bookmark"></i>
                                </span>
                            @endif
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
    <div class="d-flex justify-content-center mt-3">
        {{$allBooks->links()}}
    </div>
@endsection