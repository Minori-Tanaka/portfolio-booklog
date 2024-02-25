@extends('layouts.app')

@section('title', 'Edit Profile')

@section('sidebar')
    @include('mypage.sidebar')
@endsection
    
@section('content')
    <div class="card p-5 mt-5">
        <div class="row justify-content-start">
            <div class="col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col">
                                <h2 class="h3 text-center mt-2">Edit Profile</h2>
                            </div>
                            <div class="col-2 text-end">
                                <a href="{{route('mypage.index', Auth::user()->id)}}" class="btn">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white rounded-bottom">
                        <table class="table">
                            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <tr>
                                    <th class="align-middle">
                                        <label for="name" class="form-label mb-0">Name</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control bg-white" name="name" id="name" value="{{old('name', $user->name)}}" autofocus>
                                        @error('name')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="avatar" class="form-label mb-0">Avatar</label>
                                    </th>
                                    <td>
                                        <div class="row">
                                            <div class="col-3 pe-0">
                                                @if ($user->avatar)
                                                    <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle d-block mx-auto mt-2 avatar-md">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary d-block text-center mt-2 icon-md"></i>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <input type="file" class="form-control bg-white" name="avatar" id="avatar" value="{{old('avatar')}}" aria-describedby="cover-info">
                                                <div class="form-text" id="cover-info">
                                                    Acceptable formats: jpeg, jpg, png, gif only <br>
                                                    Maximum file size: 1048kb
                                                </div>
                                                @error('avatar')
                                                    <p class="text-danger small">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="email" class="form-label mb-0">E-mail</label>
                                    </th>
                                    <td>
                                        <input type="email" class="form-control bg-white" name="email" id="email" value="{{old('email', $user->email)}}">
                                        @error('email')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="introduction" class="form-label mb-0">Introduction</label>
                                    </th>
                                    <td>
                                        <textarea name="introduction" id="introduction" rows="5" class="form-control bg-white" placeholder="Describe your favorite books etc...">{{old('introduction', $user->introduction)}}</textarea>
                                        @error('introduction')
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