@extends('layouts.app')

@section('title', 'Followers')

@section('content')
    @include('mypage.header')

    <div class="card p-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h2 class="h3 text-center mt-2">Followers</h2>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        @if ($user->followers->isNotEmpty())
                            @foreach ($user->followers as $follower)
                                <div class="row align-items-center mt-4">
                                    <div class="col-auto">
                                        <a href="{{route('bookmark.show', $follower->follower->id)}}">
                                            @if ($follower->follower->avatar)
                                                <img src="{{$follower->follower->avatar}}" alt="{{$follower->follower->name}}" class="rounded-circle avatar-sm">
                                            @else
                                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col ps-0 text-truncate">
                                        <a href="{{route('bookmark.show', $follower->follower->id)}}" class="text-decoration-none text-dark fw-bold">
                                        {{$follower->follower->name}} 
                                        </a>
                                    </div>
                                    <div class="col-auto text-end">
                                        @if ($follower->follower->id != Auth::user()->id)
                                            @if ($follower->follower->isFollowed())
                                                <form action="{{route('follow.destroy', $follower->follower->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                                </form>
                                            @else
                                                <form action="{{route('follow.store', $follower->follower->id )}}" method="post">
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
                                            @if ($follower->follower->introduction)
                                                <p class="m-0">{{$follower->follower->introduction}}</p>
                                            @else
                                                <p class="m-0"> - </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3 class="text-muted text-center p-5">No Followers Yet</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection