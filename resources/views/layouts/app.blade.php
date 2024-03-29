<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- FA --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div id="app" class="h-100 app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand pe-5" href="{{ url('/') }}" style="font-size: 1.5em">
                    <i class="fa-solid fa-square-poll-vertical"></i> {{ config('app.name', 'Booklog') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            {{-- TODO : Search (bootstrap > input group) --}}
                            @if (request()->is('book/index'))
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Genre</button>
                                        <ul class="dropdown-menu">
                                            @foreach ($allGenres as $genre)
                                                <li><button type="button" class="dropdown-item">{{$genre->name}}</button></li>
                                            @endforeach
                                        </ul>
                                        <input type="text" class="form-control">
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item my-auto">
                                <a href="{{route('mypage.index')}}">
                                    @if (Auth::user()->avatar)
                                        <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}" class="rounded-circle avatar-sm"> 
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('mypage.index')}}">
                                        <i class="fa-solid fa-user me-2"></i> My Page
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container h-100">
            <div class="row justify-content-center h-100">
                @auth
                    {{-- Sidebar --}}
                    <div class="col-2 me-4 sidebar bg-white">
                        <ul class="nav nav-pills flex-column mt-5">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link {{request()->is('/') ? 'active bg-secondary' : 'text-dark'}}">
                                    <i class="fa-solid fa-house me-2"></i> Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('book.index')}}" class="nav-link {{request()->is('book') || request()->is('book/*') ? 'active bg-secondary' : 'text-dark'}}">
                                    <i class="fa-solid fa-book me-2"></i> Books
                                </a>
                            </li>
                            {{-- TODO? : author page --}}
                            <li class="nav-item">
                                <a href="{{route('author.index')}}" class="nav-link {{request()->is('author') ? 'active bg-secondary' : 'text-dark'}}">
                                    <i class="fa-solid fa-pen-nib me-2"></i> Authors
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('mypage.index')}}" class="nav-link {{request()->is('mypage') || (request()->is('*/' . Auth::user()->id . '/*') && !request()->is('book/*')) ? 'active bg-secondary' : 'text-dark'}}">
                                    <i class="fa-solid fa-user me-2"></i> My Page
                                </a>
                            </li>                       
                        </ul>
                    </div>
                @endauth
                <div class="col-lg-9">
                    <main class="h-100">
                        <div class="container">
                            <div class="row justify-content-center">
                                @yield('content')
                            </div>
                        </div>
                    </main>
                </div>
            </div>  
        </div>             
    </div>
    <footer class="footer container-fluid pt-5 p-0">
        <div class="container-fluid bg-secondary stickey-bottom py-2">
            <div class="container fw-light text-light">
                <div class="row justify-content-center m-2">
                    <div class="col-lg-11">
                        <div class="row">
                            <div class="col text-start position-relative">
                                <small class="position-absolute bottom-0 start-0">&copy; 2024 Booklog by MINORI</small>
                            </div>
                            <div class="col text-end p-0">
                                <div class="row mb-2">
                                    <div class="col">
                                        <i class="fa-brands fa-twitter"></i>
                                        <i class="fa-brands fa-instagram ms-2"></i>
                                        <i class="fa-brands fa-facebook-f ms-2"></i>
                                    </div>
                                </div>
                                <small>Hino-city, Tokyo, Japan</small>
                                <br>
                                <small>TEL : +81-90-9999-9999</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
