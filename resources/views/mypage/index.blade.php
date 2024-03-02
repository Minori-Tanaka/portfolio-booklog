@extends('layouts.app')

@section('title', 'My Page')
    
@section('content')
    @include('mypage.header')
    
    <div class="card px-5 pb-5">
        <h3 class="my-3">Suggestions For You</h3>
        <div class="card-body p-0">
            <div class="row">
                <div class="col">
                    <div class="row mb-4">
                        @forelse ($suggested_books as $book)
                            <div class="card p-0 m-2" style="width: 90px">
                                <a href="{{route('book.show', $book->id)}}">
                                    <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow cover-sm">
                                </a>
                                <div class="card-body p-0 pt-1">
                                    <a href="{{'book.show', $book->id}}" class="text-decoration-none text-dark">
                                        <p class="card-title text-truncate mb-0">{{$book->title}}</p>
                                    </a>
                                    {{-- TODO? : to author page --}}
                                    <a href="#" class="text-decoration-none text-dark">
                                        <p class="small text-truncate p-0">{{$book->author}}</p>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-muted text-center py-5">No Books Yet</h3>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3>Books finished this month</h3>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <a href="{{route('bookmark.show', $user->id)}}">
                                    @if ($user->avatar)
                                        <img src="{{$user->avatar}}" alt="{{$user->name}}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{route('bookmark.show', $user->id)}}" class="text-decoration-none text-dark fw-bold">
                                    {{$user->name}}
                                </a>
                            </div>
                            <div class="col-auto">
                                <form action="{{route('follow.store', $user->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">
                                        Follow
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection