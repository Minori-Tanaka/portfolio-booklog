@extends('layouts.app')

@section('title', $user->name . 's Bookmark')

@section('sidebar')
    @include('mypage.sidebar')
@endsection
    
@section('content')
    @include('mypage.header')

    <ul class="nav nav-tabs mt-2">
        <li class="nav-item">
            <a class="nav-link text-white bg-dark" href="{{route('bookmark.index')}}">
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
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">
            <i class="fa-regular fa-user me-1"></i> Profile
          </a>
        </li>
    </ul> 

    <div class="card p-5">
      @if ($user->bookmarks->isNotEmpty())
          <div class="row justifi-content-center">
              @foreach ($user->bookmarks as $bookmark)
                  <div class="col-lg-2">
                      <div class="card bg-transparent">
                          <a href="{{route('book.show', $bookmark->book->id)}}">
                              <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow w-100">
                          </a>
                          <div class="card-body ps-0 pt-2">
                              <a href="{{'book.show', $bookmark->book->id}}" class="text-decoration-none text-dark">
                                  <h6 class="text-truncate mb-0">{{$bookmark->book->title}}</h6>
                              </a>
                              {{-- TODO? : to author page --}}
                              <a href="#" class="text-decoration-none text-dark">
                                  <p class="small">{{$bookmark->book->author}}</p>
                              </a>
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