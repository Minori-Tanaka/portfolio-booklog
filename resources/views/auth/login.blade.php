@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container" style="margin-top: 150px">
    <div class="row justify-content-center">
        <div class="card">
            <div class="row">
                <div class="col p-0">
                    <div class="card-header rounded-start text-center h-100 position-relative">
                        <span class="position-absolute top-50 start-50 translate-middle w-100">
                            <div class="icon-sm">
                                <i class="fa-solid fa-square-poll-vertical"></i>
                            </div>
                            <h1 class="display-5">Booklog</h1>
                            <p class="small">Explore, Log, and Share Your Reading Journey</p>
                        </span>
                    </div>
                </div>
                <div class="col p-0">
                    <div class="card-body p-5">
                        <div class="card-title h2 text-center mb-3">{{ __('Login') }}</div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="email">{{ __('Email Address') }}</label>
    
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="row mb-4">
                                <label for="password">{{ __('Password') }}</label>
    
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="row mb-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-dark w-50">
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
</div>
@endsection
