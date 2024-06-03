<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - {{ config('app.name', 'Renegade Community') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" as="preload" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" as="preload" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top shadow-5-strong mb-5">
        <div class="container">
            <a class="navbar-brand" href="/index.php">
                <img src="{{ asset('assets/pictures/rgrp_logo.png') }}" alt="RGRP_LGOO" height="50">
            </a>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            @auth
            {{-- Check if logged in --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 65%">
                <ul class="navbar-nav mr-auto">  
            @else
            {{-- if not logged in --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">       
            @endauth
                    <li class="nav-tem">
                        <a class="nav-link" href="/">Home</a>
                    </li>
    
                    <li class="nav-tem">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>

                    <li class="nav-tem">
                        <a class="nav-link" href="{{ route('download') }}">Download</a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Highscores
                        </a>        
    
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('highscores.playingtime') }}">Active Players</a>
                            <a class="dropdown-item" href="{{ route('highscores.wealthiest') }}">Wealthiest Players</a>
                            <a class="dropdown-item" href="{{ route('highscores.skins') }}">Used Skins</a>
                            <a class="dropdown-item" href="{{ route('highscores.vehiclemodels') }}">Popular Vehicle Models</a>
                        </div>
                    </li>  
    
                    @guest
                    <li class="nav-tem">
                        <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                    </li>
                    @endguest
    
                    <!-- li class="nav-tem">
                        <a class="nav-link" href="./?page=donate">Donate</a>
                    </li -->
    
                    <li class="nav-tem">
                        <a class="nav-link" href="http://renegadecommunity.xyz/discord">Discord</a>
                    </li>
    
                </ul>   
            </div>
    
            @auth
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">       
                    
                    <!-- Admin Panel -->
                    @if($adminStatus > 0)
                    {
                        <li class="nav-tem">
                            <a class="nav-link" href="{{ route('admin.index') }}">Admin Panel</a>
                        </li>
                    }
                    @endif
    
                    <!-- My Characters -->
                    <li class="nav-tem">
                        <a class="nav-link" href="{{ route('user.index') }}">My Characters</a>
                    </li>
    
                    <!-- User's Name -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ $username }}
                        </a>        
    
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.settings') }}">Settings</a>
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
    
                </ul>   
            </div>
            @endauth
        </div>
    </nav>

    <!-- Content -->
    <main role="main" class="flex-grow-1 overflow-auto">
        @include('includes.time')

        @yield('content')
    </main>

    <!-- Footer -->
    @include('includes.footer')

    @yield('scripts')
</body>
</html>
