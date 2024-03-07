@extends('layouts.app')

@section('title', 'Reading Status')
    
@section('content')
    @include('mypage.header')

    <div class="card p-5">
        <div class="row">
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Finished</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @foreach ($reviewed_books as $book)
                            @if ($book->status == 'Finished')
                                <a href="{{route('review.show', ['book_id' => $book->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$book->book->cover_photo}}" alt="{{$book->book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Reading</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @foreach ($reviewed_books as $book)
                            @if ($book->status == 'Reading')
                                <a href="{{route('review.show', ['book_id' => $book->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$book->book->cover_photo}}" alt="{{$book->book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Want</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @foreach ($reviewed_books as $book)
                            @if ($book->status == 'Want')
                                <a href="{{route('review.show', ['book_id' => $book->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$book->book->cover_photo}}" alt="{{$book->book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Unset</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @foreach ($reviewed_books as $book)
                            @if ($book->status == 'Unset')
                                <a href="{{route('review.show', ['book_id' => $book->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$book->book->cover_photo}}" alt="{{$book->book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                            @endif
                        @endforeach
                        
                        @foreach ($user->bookmarks as $bookmark)
                            @if (!$bookmark->isReviewed($user->id))
                                <a href="{{route('review.show', ['book_id' => $bookmark->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if (!isset($book->status))
            <h3 class="text-muted text-center mt-3">Not yet set Status</h3>
        @endif
  </div>
@endsection