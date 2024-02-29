@extends('layouts.app')

@section('title', 'Edit Review')
    
@section('content')
    <div class="card p-5 mt-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Edit Review</h2>
                            </div>
                            <div class="col-auto text-end my-auto">
                                <button class="btn btn-close" onclick="history.back()"></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <div class="row">
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
                            </div>
                        </div>
                        <hr>
                        <table class="table">
                            <form action="{{route('review.update', $book->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <tr>
                                    <th class="align-middle">
                                        <label for="title" class="form-label mb-0">Rating</label>
                                    </th>
                                    <td>
                                        <div class="stars">
                                            <span>
                                                @for ($i = 5; $i >= 1; $i--)
                                                    @if ($i == $review->rating)
                                                        <input id="rating{{$i}}" type="radio" name="rating" value="{{$i}}" checked>
                                                        <label for="rating{{$i}}">★</label>
                                                    @else
                                                        <input id="rating{{$i}}" type="radio" name="rating" value="{{$i}}">
                                                        <label for="rating{{$i}}">★</label>
                                                    @endif
                                                @endfor
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="content">Review</label>
                                    </th>
                                    <td>
                                        <textarea name="content" id="content" rows="5" class="form-control">{{old('content', $review->content)}}</textarea>
                                        @error('content')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="status">Status</label>
                                    </th>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <input type="radio" name="status" id="unset" value="Unset" class="btn-check" {{ $review->status == 'Unset' ? 'checked' : '' }}>
                                            <label for="unset" class="btn btn-outline-dark">Unset</label>
                                            <input type="radio" name="status" id="want" value="Want" class="btn-check" {{ $review->status == 'Want' ? 'checked' : '' }}>
                                            <label for="want" class="btn btn-outline-dark">Want</label>
                                            <input type="radio" name="status" id="reading" value="Reading" class="btn-check" {{ $review->status == 'Reading' ? 'checked' : '' }}>
                                            <label for="reading" class="btn btn-outline-dark">Reading</label>
                                            <input type="radio" name="status" id="finished" value="Finished" class="btn-check" {{ $review->status == 'Finished' ? 'checked' : '' }}>
                                            <label for="finished" class="btn btn-outline-dark">Finished</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="category">Category</label>
                                    </th>
                                    <td>
                                        @foreach ($user->categories as $category)
                                            <div class="form-check form-check-inline">
                                                @if (in_array($category->id, $selected_categories))
                                                    <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input" checked>
                                                    <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
                                                @else
                                                    <input type="checkbox" name="category[]" id="{{$category->name}}" value="{{$category->id}}" class="form-check-input">
                                                    <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
                                                @endif
                                            </div>
                                        @endforeach
                                        <button type="button" class="btn text-decoration-underline" data-bs-toggle="modal" data-bs-target="#create-category">
                                            <i class="fa-solid fa-circle-plus"></i> Add
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-dark w-50 my-3">
                                            <i class="fa-solid fa-pen me-1"></i> Save
                                        </button>
                                    </td>
                                </tr>
                            </form>
                            @include('mypage.categories.modals.create')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

