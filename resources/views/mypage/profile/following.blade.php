@extends('layouts.app')

@section('title', 'Following')

@section('content')
    @include('mypage.header')

    <div class="card p-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Following</h2>
                            </div>
                            <div class="col-auto text-end my-auto">
                                <button class="btn btn-close" onclick="history.back()"></button>
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