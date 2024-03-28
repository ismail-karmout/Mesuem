<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .image-background {
            height: 100vh;
            min-height: 500px;
            background-image: url("/storage/dist/img/auth.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    @yield('css')
</head>

<body id="page-top">
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        </nav> --}}
        <div class="position-relative">


            <nav class="navbar navbar-expand-lg position-absolute top-0 start-50 translate-middle-x px-0 py-1 w-100">
                <div class="container-xl">
                    <!-- Logo -->
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('/storage/dist/img/museum.png') }}" height="40px" alt="">
                    </a>
                    <!-- Navbar toggle -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Nav -->
                        <div class="navbar-nav mx-lg-auto">
                            <a class="nav-item nav-link mx-2 text-light fs-semibold fs-5 rounded-pill {{ Request::segment(1) == '' ? 'bg-info' : '' }} "
                                href="/" aria-current="page">Home</a>
                            <a class="nav-item nav-link mx-2  text-light fs-semibold fs-5 rounded-pill {{ Request::segment(1) == 'artist' ? 'bg-info' : '' }} "
                                href="{{ route('artist.index')}}">Artistes</a> 
                            <a class="nav-item nav-link mx-2  text-light fs-semibold fs-5 rounded-pill {{ Request::segment(1) == 'artworks' ? 'bg-info' : '' }}"
                                href="{{ route('oeuvre.index')}}">Œuvres</a>
                            <a class="nav-item nav-link mx-2  text-light fs-semibold fs-5 rounded-pill {{ Request::segment(1) == 'visits' ? 'bg-info' : '' }}" 
                                href="{{ route('visits.index')}}">Visite</a>
                                <a class="nav-item nav-link mx-2  text-light fs-semibold fs-5 rounded-pill {{ Request::segment(1) == 'calendar' ? 'bg-info' : '' }}" 
                                href="{{ route('calendar.index')}}">Activités</a>
                        </div>
                        @auth
                            <p class="text-sm text-gray-700 dark:text-gray-500 underline">{{ Auth::user()->name }}</p>
                        @else
                            <div class="navbar-nav ms-lg-4">
                                <a href="{{ route('login') }}" class="btn btn-warning mx-1 btn-md w-full w-lg-auto">
                                    Login
                                </a>
                            </div>
                            @if (Route::has('register'))
                                <div class="d-flex align-items-lg-center mt-3 mt-lg-0">
                                    <a href="{{ route('register') }}" class="btn btn-info btn-md w-full w-lg-auto">
                                        Register
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </nav>
            <div class='image-background'>
                <div class='container h-100'>
                    <div class='row h-100 align-items-center'>
                        @yield('image-title')
                    </div>
                </div>
            </div>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
