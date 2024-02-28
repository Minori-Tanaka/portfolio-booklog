@extends('layouts.app')

@section('title', 'My Page')
    
@section('content')
    @include('mypage.header')
    
    <div class="card px-4">
        <h3 class="h4 mt-3 mb-0">Suggestions</h3>
        <div class="card-body">
            {{-- @if ($suggested_books) --}}
                <div class="row">
                    @foreach ($suggested_books as $book)
                        <div class="card p-0 m-2" style="width: 90px">
                            <a href="{{route('review.show', ['book_id' => $book->id, 'user_id' => $book->id])}}">
                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="card-image-top shadow w-100">
                            </a>
                            <div class="card-body pt-0 pe-0">
                                <div class="d-flex justify-content-end">
                                    {{-- TODO? : rating --}}
                                    {{-- @if ($review->rating)
                                        <span class="star5_rating mb-2" data-rate="{{$review->rating}}"></span>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            {{-- @else
                <h3 class="text-muted text-center py-5">No Books Yet</h3>
            @endif  --}}
        </div>
    </div>
@endsection