@extends('layouts.app')

@section('title', $user->name . 's Bookmark')
    
@section('content')
    @include('mypage.header')

    <div class="card p-5">
        @if ($user->bookmarks->isNotEmpty())
            <div class="row">
                @foreach ($user->bookmarks as $bookmark)
                    <div class="card p-0 m-2" style="width: 90px">
                        <a href="{{route('review.show', ['book_id' => $bookmark->book->id, 'user_id' => $bookmark->user->id])}}">
                            <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow w-100">
                        </a>
                        <div class="card-body pt-0 pe-0">
                            <div class="d-flex justify-content-end">
                                {{-- TODO? : rating --}}
                                {{-- @if ()
                                    <span class="star5_rating" data-rate="#"></span>
                                @endif --}}
                                {{-- TODO : review, status --}}
                                <button class="btn p-0">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <h3 class="text-muted text-center py-5">No Bookmarks Yet</h3>
        @endif        
  </div>
@endsection