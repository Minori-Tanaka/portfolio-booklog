@extends('layouts.app')

@section('title', 'Following')

@section('sidebar')
    @include('mypage.sidebar')
@endsection

@section('content')
    @include('mypage.header')

    <ul class="nav nav-tabs mt-2">
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('bookmark.show', $user->id)}}">
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
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Following</h2>
                            </div>
                            <div class="col-2 text-end">
                                <a href="{{route('mypage.index', $user->id)}}" class="btn">
                                    <i class="fa-solid fa-xmark py-2" style="font-size: 1.2em"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        @if ($user->following->isNotEmpty())
                            @foreach ($user->following as $following)
                                <div class="row align-items-center mt-4">
                                    <div class="col-auto">
                                        <a href="{{route('bookmark.show', $following->following->id)}}">
                                            @if ($following->following->avatar)
                                                <img src="{{$following->following->avatar}}" alt="{{$following->following->name}}" class="rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col ps-0 text-truncate">
                                        <a href="{{route('bookmark.show', $following->following->id)}}" class="text-decoration-none text-dark fw-bold">
                                        {{$following->following->name}} 
                                        </a>
                                    </div>
                                    <div class="col-auto text-end">
                                        @if ($following->following->id != Auth::user()->id)
                                            @if ($following->following->isFollowed())
                                                <form action="{{route('follow.destroy', $following->following->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                                </form>
                                            @else
                                                <form action="{{route('follow.store', $following->following->id )}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <div class="card p-2">
                                            @if ($following->following->introduction)
                                                <p class="m-0">{{$following->following->introduction}}</p>
                                            @else
                                                <p class="m-0"> - </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-muted text-center p-5">No Following Yet</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection