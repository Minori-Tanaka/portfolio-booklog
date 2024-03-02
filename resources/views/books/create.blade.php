@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
    <div class="card p-5 mt-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-auto"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Add new Book</h2>
                            </div>
                            <div class="col-auto text-end my-auto">
                                {{-- <a href="{{route('book.index')}}" class="btn btn-close"></a> --}}
                                <button class="btn btn-close" onclick="history.back()"></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <table class="table">
                            <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <tr>
                                    <th class="align-middle">
                                        <label for="title">Title</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" autofocus>
                                        @error('title')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="author">Author</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" name="author" id="author" value="{{old('author')}}">
                                        @error('author')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="published_year">Published Year</label>
                                    </th>
                                    <td>
                                        <input type="text" maxlength="4" class="form-control" name="published_year" id="published_year" value="{{old('published_year')}}" placeholder="YYYY">
                                        @error('published_year')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="cover_photo">Cover Photo</label>
                                    </th>
                                    <td>
                                        <input type="file" class="form-control" name="cover_photo" id="cover_photo" value="{{old('cover_photo')}}" aria-describedby="cover-info">
                                        <div class="form-text" id="cover-info">
                                            Acceptable formats: jpeg, jpg, png, gif only <br>
                                            Maximum file size: 1048kb
                                        </div>
                                        @error('cover_photo')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="genre_id">Genre</label>
                                    </th>
                                    <td>
                                        <select class="form-select" name="genre_id" id="genre_id">
                                            <option selected>Select Genre</option>
                                            @foreach ($allGenres as $genre)
                                                <option value="{{$genre->id}}">{{$genre->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('genre_id')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="description">Description</label>
                                    </th>
                                    <td>
                                        <textarea name="description" id="description" rows="5" class="form-control">{{old('description')}}</textarea>
                                        @error('description')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-dark w-50 my-3">
                                            <i class="fa-solid fa-plus me-1"></i> Add
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