@extends('layouts.app')

@section('title', 'My Page')

@section('sidebar')
    @include('mypage.sidebar')
@endsection
    
@section('content')
    @include('mypage.header')

    <ul class="nav nav-tabs mt-2">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('bookmark.index')}}">
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

    <div class="container py-3">
        <h3 class="h5">Suggestions</h3>
        <div class="card">
            <div class="card-body">
                <p>hello</p>
            </div>
        </div>
    </div>
@endsection