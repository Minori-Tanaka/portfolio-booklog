@extends('layouts.app')

@section('title', $user->name . 's Bookmark')

@section('sidebar')
    @include('mypage.sidebar')
@endsection
    
@section('content')
    @include('mypage.header')

    <ul class="nav nav-tabs mt-2">
        <li class="nav-item">
            <a class="nav-link active text-white bg-dark" href="{{route('bookmark.show', $user->id)}}">
                <i class="fa-regular fa-bookmark me-1"></i> Bookmark
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">
            <i class="fa-solid fa-square-poll-vertical me-1"></i> Reading Log
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Link</a>
        </li>
    </ul> 

    <div class="card p-5">
        @if ($user->bookmarks->isNotEmpty())
            <div class="row justifi-content-center">
                @foreach ($user->bookmarks as $bookmark)
                    <div class="card p-0 m-2" style="width: 90px">
                        <a href="{{route('book.show', $bookmark->book->id)}}">
                            <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow w-100">
                        </a>
                        <div class="card-body pt-0 pe-0">
                            <div class="d-flex justify-content-end">
                                {{-- TODO? : rating --}}
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