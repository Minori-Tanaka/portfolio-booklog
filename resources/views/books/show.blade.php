@extends('layouts.app')

@section('title', $book->title)

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
                        <h3>{{$book->title}}</h3>
                        {{-- TODO? : to author page --}}
                        <p class="text-muted fw-bold mb-2">by {{$book->author}}</p>
                        <p class="text-muted">Published in {{$book->published_year}}</p>
                        <div class="d-flex">
                            @if ($book->isBookmarked())
                                {{-- TODO : if already bookmark -> check mark, review ditail --}}
                                <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => Auth::user()->id])}}" class="btn btn-secondary">
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
        <h3>Reviews</h3>
        <div class="row justify-content-start">
            <div class="col-8">
                @foreach ($book->reviews as $review)
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="{{route('bookmark.show', $review->user)}}">
                                        @if ($review->user->avatar)
                                            <img src="{{$review->user->avatar}}" alt="{{$review->user->name}}" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="col ps-0">
                                    <a href="{{route('bookmark.show', $review->user)}}" class="text-decoration-none text-dark">{{$review->user->name}}</a>
                                </div>
                                <div class="col-auto">
                                    @if (Auth::user()->id === $review->user->id)
                                        {{-- TODO : to review ditails --}}
                                        <a href="#" class="btn btn-link btn-sm text-dark">Details</a>
                                    @else
                                        @if ($review->user->isFollowed())
                                            <form action="{{route('follow.destroy', $review->user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                            </form>
                                        @else
                                            <form action="{{route('follow.store', $review->user->id)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body bg-white px-4">
                            <div class="row">
                                <div class="col">
                                    @if ($review->rating)
                                        <span class="star5_rating mb-2" data-rate="{{$review->rating}}"></span>
                                    @endif
                                </div>
                                <div class="col text-end">
                                    <span class="text-muted small m-0">{{date('M d, Y', strtotime($review->created_at))}}</span>
                                </div>
                            </div>
                            <p>{{$review->content}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>
        
    </div>
@endsection