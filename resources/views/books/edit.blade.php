@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    <div class="card p-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h2 class="h3 text-center my-auto">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Book
                        </h2>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <table class="table">
                            <form action="{{route('book.update', $book->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <tr>
                                    <th class="align-middle">
                                        <label for="title" class="form-label mb-0">Title</label>
                                    </th>
                                    <td class="bg-white">
                                        <input type="text" class="form-control bg-white" name="title" id="title" value="{{old('title', $book->title)}}" autofocus>
                                        @error('title')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="author" class="form-label mb-0">Author</label>
                                    </th>
                                    <td class="bg-white">
                                        <input type="text" class="form-control bg-white" name="author" id="author" value="{{old('author', $book->author)}}">
                                        @error('author')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="published_year" class="form-label mb-0">Published Year</label>
                                    </th>
                                    <td class="bg-white">
                                        <input type="text" maxlength="4" class="form-control bg-white" name="published_year" id="published_year" value="{{old('published_year', $book->published_year)}}" placeholder="YYYY">
                                        @error('published_year')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="cover_photo" class="form-label mb-0">Cover Photo</label>
                                    </th>
                                    <td class="bg-white">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="{{$book->cover_photo}}" alt="{{$book->title}}" width="100%">
                                            </div>
                                            <div class="col">
                                                <input type="file" class="form-control bg-white" name="cover_photo" id="cover_photo" value="{{old('cover_photo')}}" aria-describedby="cover-info">
                                                <div class="form-text" id="cover-info">
                                                    Acceptable formats: jpeg, jpg, png, gif only <br>
                                                    Maximum file size: 1048kb
                                                </div>
                                                @error('cover_photo')
                                                    <p class="text-danger small">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="genre_id" class="form-label mb-0">Genre</label>
                                    </th>
                                    <td class="bg-white">
                                        <select class="form-select bg-white" name="genre_id" id="genre_id">
                                            <option selected>Select Genre</option>
                                            @foreach ($allGenres as $genre)
                                                @if ($genre->id == $book->genre->id)
                                                    <option value="{{$genre->id}}" selected>{{$genre->name}}</option>
                                                @else
                                                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('genre_id')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="description" class="form-label mb-0">Description</label>
                                    </th>
                                    <td class="bg-white">
                                        <textarea name="description" id="description" rows="5" class="form-control bg-white">{{old('description', $book->description)}}</textarea>
                                        @error('description')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-white text-center">
                                        <button type="submit" class="btn btn-dark w-50 my-3">
                                            <i class="fa-solid fa-pen me-1"></i> Update
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection