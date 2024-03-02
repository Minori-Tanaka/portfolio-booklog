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
                        @forelse ($finished_books as $book)
                            <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm" style="width: 5.4vw; margin-right: 1vw">
                            </a> 
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Reading</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @forelse ($reading_books as $book)
                            <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm" style="width: 5.4vw; margin-right: 1vw">
                            </a>
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Want</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @forelse ($want_books as $book)
                            <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm" style="width: 5.4vw; margin-right: 1vw">
                            </a>
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Unset</h3>
                    <div class="d-flex overflow-x-scroll my-3">
                        @foreach ($unset_books as $book)
                            <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm" style="width: 5.4vw; margin-right: 1vw">
                            </a>
                        @endforeach
                        
                        @foreach ($user->bookmarks as $bookmark)
                            @if (!$bookmark->isReviewed($user->id))
                                <a href="{{route('review.show', ['book_id' => $bookmark->book->id, 'user_id' => $user->id])}}">
                                    <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow cover-sm" style="width: 5.4vw; margin-right: 1vw">
                                </a>
                            @endif
                        @endforeach
                        
                        @if ($unset_books->isEmpty() && $user->bookmarks->isEmpty())
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div> 
  </div>
@endsection