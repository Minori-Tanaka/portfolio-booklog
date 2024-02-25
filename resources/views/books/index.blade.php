@extends('layouts.app')

@section('title', 'Book List')

@section('sidebar')
    @include('books.sidebar')
@endsection

@section('content')
    <a href="{{route('book.create')}}" class="btn text-start btn-font py-0 mt-2" title="Add book">
        <i class="fa-solid fa-circle-plus"></i>
    </a>
    <div class="card p-5">
        @if ($allBooks->isNotEmpty())
            <div class="row justifi-content-center">
                @foreach ($allBooks as $book)
                    <div class="card p-0 m-2" style="width: 133px">
                        <a href="{{route('book.show', $book->id)}}" class="position-relative">
                            <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow w-100">
                            @if ($book->isBookmarked())
                                <span class="position-absolute top-0 end-0 p-0 badge text-warning" style="font-size: 1.8em">
                                    <i class="fa-solid fa-bookmark"></i>
                                </span>
                            @endif
                        </a>
                        <div class="card-body bg-white pt-2">
                            <a href="{{'book.show', $book->id}}" class="text-decoration-none text-dark">
                                <h6 class="card-title text-truncate mb-0">{{$book->title}}</h6>
                            </a>
                            {{-- TODO? : to author page --}}
                            <a href="#" class="text-decoration-none text-dark">
                                <p class="small mb-2">{{$book->author}}</p>
                            </a>
                            @if ($book->isBookmarked())
                                {{-- TODO : if already bookmark -> check mark, review ditail --}}
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-sm btn-secondary">
                                        <i class="fa-regular fa-circle-check me-1"></i> Saved
                                    </a>
                                </div>
                                
                            @else
                                <div class="d-flex justify-content-center">
                                    <form action="{{route('bookmark.store', $book->id)}}" method="post" class="">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-dark">
                                            <i class="fa-solid fa-bookmark me-1"></i> Bookmark
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center py-5">No Books Yet</h3>
        @endif        
    </div>
@endsection