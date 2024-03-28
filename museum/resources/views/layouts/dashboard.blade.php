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

    @yield('files')


    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <!-- Scripts -->
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto ">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('storage/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('home') }}"
                                    class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subscribers.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'subscribers' ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Gestion des abonnés
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('artists.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'artists' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Gestion des artistes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('artworks.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'artworks' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Gestion des oeuvres
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('salles.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'salles' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Gestion des salles
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manifestations.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'manifestations' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Manifestations
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('conferenciers.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'conferences' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Conférences
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tarifs.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'tarifs' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Tarifs
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reservations.index') }}"
                                    class="nav-link  {{ Request::segment(1) == 'reservations' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Réservations
                                    </p>
                                </a>
                            </li>
                        @elseif (Auth::user()->role == 'subscriber')
                            <li class="nav-item">
                                <a href="{{ route('subscriber') }}"
                                    class="nav-link {{ Request::segment(1) == 'subscriber' ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}"
                                    class="nav-link {{ Request::segment(1) == 'profile' ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Se déconnecter
                                </p>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('titlePage')</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
