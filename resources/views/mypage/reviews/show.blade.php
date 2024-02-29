@extends('layouts.app')

@section('title', 'Review')
    
@section('content')
    <div class="card p-5 mt-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Review</h2>
                            </div>
                            <div class="col-auto text-end my-auto">
                                <button class="btn btn-close" onclick="history.back()"></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <div class="row position-relative">
                            <div class="col-3 pe-3">
                                @if ($book->cover_photo)
                                    <a href="{{route('book.show', $book->id)}}">
                                        <img src="{{$book->cover_photo}}" alt="{{$book->title}}" class="shadow w-100">
                                    </a>
                                @else
                                    <i class="fa-solid fa-image fa-10x text-secondary"></i>
                                @endif
                            </div>
                            <div class="col">
                                <a href="{{route('book.show', $book->id)}}" class="text-decoration-none text-dark">
                                    <h3>{{$book->title}}</h3>
                                </a>
                                {{-- TODO? : to author page --}}
                                <p class="text-muted fw-bold mb-2">by {{$book->author}}</p>
                                <p class="text-muted">Published in {{$book->published_year}}</p>
                                @if ($user->id === Auth::user()->id)
                                    @if ($review)
                                        {{-- Edit --}}
                                        <div class="position-absolute bottom-0 end-0 me-3">
                                            <a href="{{route('review.edit', ['book_id' => $book->id, 'user_id' => Auth::user()->id])}}" class="btn btn-outline-dark me-2" title="Edit Review">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                            </a>
                                            {{-- Delete --}}
                                            <button class="btn btn-danger" title="Delete Review" data-bs-toggle="modal" data-bs-target="#delete-review-{{$book->id}}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                        @include('mypage.reviews.modal.delete')
                                    @else
                                        <div class="position-absolute bottom-0 end-0 me-3">
                                            <a href="{{route('review.create', $book->id)}}" class="btn btn-dark" title="Create Review">
                                                <i class="fa-solid fa-plus me-1"></i> Review
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <hr>
                        @if ($review)
                            <p class="text-end text-muted small m-0">{{date('M d, Y', strtotime($review->created_at))}}</p>
                        
                            <table class="table">
                                @if ($review->rating !== null)
                                    <tr>
                                        <th class="col-2 align-middle">
                                            <label for="title" class="form-label mb-0">Rating</label>
                                        </th>
                                        <td>
                                            <span class="star5_rating star5_rating_md mb-2" data-rate="{{$review->rating}}"></span>
                                        </td>
                                    </tr>        
                                @endif
                                
                                @if ($review->content !== null)
                                    <tr>
                                        <th class="col-2 align-middle">
                                            <label for="content">Review</label>
                                        </th>
                                        <td>
                                            <p class="my-2">{{$review->content}}</p>
                                        </td>
                                    </tr>
                                @endif

                                @if ($review->status !== null)
                                    <tr>
                                        <th class="col-2 align-middle">
                                            <label for="status">Status</label>
                                        </th>
                                        <td>
                                            {{-- TODO : to status page --}}
                                            <div class="btn-group" role="group">
                                                <input type="radio" name="status" id="unset" value="Unset" class="btn-check" {{ $review->status == 'Unset' ? 'checked' : '' }} disabled>
                                                <label for="unset" class="btn btn-outline-dark">Unset</label>
                                                <input type="radio" name="status" id="want" value="Want" class="btn-check" {{ $review->status == 'Want' ? 'checked' : '' }} disabled>
                                                <label for="want" class="btn btn-outline-dark">Want</label>
                                                <input type="radio" name="status" id="reading" value="Reading" class="btn-check" {{ $review->status == 'Reading' ? 'checked' : '' }} disabled>
                                                <label for="reading" class="btn btn-outline-dark">Reading</label>
                                                <input type="radio" name="status" id="finished" value="Finished" class="btn-check" {{ $review->status == 'Finished' ? 'checked' : '' }} disabled>
                                                <label for="finished" class="btn btn-outline-dark">Finished</label>
                                            </div>
                                            {{-- <div class="btn-group" role="group">
                                                <button name="status" id="unset" value="Unset" class="btn btn-outline-dark" {{ $review->status == 'Unset' ? 'checked' : '' }}>{{$review->status}}</button>
                                                <input type="radio" name="status" id="want" value="Want" class="btn-check" {{ $review->status == 'Want' ? 'checked' : '' }}>
                                                <label for="want" class="btn btn-outline-dark">Want</label>
                                                <input type="radio" name="status" id="reading" value="Reading" class="btn-check" {{ $review->status == 'Reading' ? 'checked' : '' }}>
                                                <label for="reading" class="btn btn-outline-dark">Reading</label>
                                                <input type="radio" name="status" id="finished" value="Finished" class="btn-check" {{ $review->status == 'Finished' ? 'checked' : '' }}>
                                                <label for="finished" class="btn btn-outline-dark">Finished</label>
                                            </div>
                                            <a href="#" class="text-dark">
                                                <p class="my-2">{{$review->status}}</p>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endif

                                    <tr>
                                        <th class="col-2 align-middle pe-3">
                                            <label for="category">Category</label>
                                        </th>
                                        <td>
                                            <div class="my-2">
                                                @foreach ($user->categories as $category)
                                                    @if (in_array($category->id, $selected_categories))
                                                        {{-- TODO : to category page --}}
                                                        <a href="#" class="text-dark">
                                                            <span class="pe-3">{{$category->name}}</span>
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @if ($selected_categories == null)
                                                    <a href="#" class="text-dark">Unset</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection