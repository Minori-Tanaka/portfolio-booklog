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
                            <img src="{{$bookmark->book->cover_photo}}" alt="{{$bookmark->book->title}}" class="card-image-top shadow cover-sm">
                        </a>
                        <div class="card-body pt-0 pe-0">
                            <div class="d-flex justify-content-end">
                                {{-- TODO? : rating --}}
                                {{-- @if ($review->rating)
                                    <span class="star5_rating mb-2" data-rate="{{$review->rating}}"></span>
                                @endif --}}

                                {{-- bookmark delete --}}
                                <button class="btn p-0 mt-1" title="Delete Bookmark" data-bs-toggle="modal" data-bs-target="#delete-bookmark-{{$bookmark->book->id}}">
                                    <i class="fa-solid fa-square-minus text-danger" style="font-size: 1.3em"></i>
                                </button>
                                @include('mypage.bookmarks.modal.delete')
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