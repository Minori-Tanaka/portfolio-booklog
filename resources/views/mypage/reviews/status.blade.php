@extends('layouts.app')

@section('title', 'Reading Status')
    
@section('content')
    @include('mypage.header')

    <div class="card p-5">
        <div class="row">
            <div class="col">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Finished</h3>
                    <div class="row">
                        @forelse ($finished_books as $book)
                                <div class="card bg-transparent p-0 m-2" style="width: 90px">
                                    <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                        <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm">
                                    </a>
                                </div> 
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Reading</h3>
                    <div class="row">
                        @forelse ($reading_books as $book)
                                <div class="card bg-transparent p-0 m-2" style="width: 90px">
                                    <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                        <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm">
                                    </a>
                                </div> 
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Want</h3>
                    <div class="row">
                        @forelse ($want_books as $book)
                                <div class="card bg-transparent p-0 m-2" style="width: 90px">
                                    <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                        <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm">
                                    </a>
                                </div> 
                        @empty
                            <h4 class="text-muted text-center mt-2">No Books Yet</h4>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-white border px-4 pb-4 mb-3">
                    <h3 class="h4 mt-3">Unset</h3>
                    <div class="row">
                        @foreach ($unset_books as $book)
                                <div class="card bg-transparent p-0 m-2" style="width: 90px">
                                    <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $user->id])}}">
                                        <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm">
                                    </a>
                                </div> 
                        @endforeach
                        
                        @foreach ($user->bookmarks as $bookmark)
                            @if (!$bookmark->isReviewed($user->id))
                                <div class="card bg-transparent p-0 m-2" style="width: 90px">
                                    <a href="{{route('review.show', ['book_id' => $bookmark->book->id, 'user_id' => $user->id])}}">
                                        <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow cover-sm">
                                    {{-- </a> --}}
                                </div> 
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