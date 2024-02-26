@extends('layouts.app')

@section('sidebar')
    <ul class="nav nav-pills flex-column bg-light mt-5">
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link text-dark">
                <i class="fa-solid fa-house me-2"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('book.index')}}" class="nav-link text-dark">
                <i class="fa-solid fa-book me-2"></i> Book List
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ Auth::check() ? route('mypage.index', Auth::user()->id) : route('login') }}" class="nav-link text-dark">
                <i class="fa-solid fa-user me-2"></i> My Page
            </a>
        </li>                       
    </ul>
@endsection

@section('content')
<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
