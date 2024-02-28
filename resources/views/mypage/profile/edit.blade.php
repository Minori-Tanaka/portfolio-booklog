@extends('layouts.app')

@section('title', 'Edit Profile')
    
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
                                <a href="{{route('mypage.index')}}" class="btn">
                                    <i class="fa-solid fa-xmark py-2" style="font-size: 1.2em"></i>
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
                                        <label for="name">Name</label>
                                    </th>
                                    <td>
                                        <input type="text" class="form-control" name="name" id="name" value="{{old('name', $user->name)}}" autofocus>
                                        @error('name')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="avatar">Avatar</label>
                                    </th>
                                    <td>
                                        <div class="row">
                                            <div class="col-3 pe-0">
                                                @if ($user->avatar)
                                                    <img src="{{$user->avatar}}" alt="{{$user->name}}" class="img-thumbnail rounded-circle d-block mx-auto m-2 avatar-md">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary d-block text-center m-2 icon-md"></i>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <input type="file" class="form-control" name="avatar" id="avatar" value="{{old('avatar')}}" aria-describedby="cover-info">
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
                                        <label for="email">E-mail</label>
                                    </th>
                                    <td>
                                        <input type="email" class="form-control" name="email" id="email" value="{{old('email', $user->email)}}">
                                        @error('email')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">
                                        <label for="introduction">Introduction</label>
                                    </th>
                                    <td>
                                        <textarea name="introduction" id="introduction" rows="5" class="form-control" placeholder="Describe your bookshelf">{{old('introduction', $user->introduction)}}</textarea>
                                        @error('introduction')
                                            <p class="text-danger small">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
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