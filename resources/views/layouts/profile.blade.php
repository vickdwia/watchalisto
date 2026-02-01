<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Watchalisto' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logoup.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            z-index: 1030;
        }

        .nav-link {
            color: rgba(255,255,255,0.7);
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #14b8a6;
        }

        .logo-img {
            height: 38px;
            width: auto;
        }
    </style>


    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-4">
            <a href="/dashboard" class="d-flex align-items-center">
                <img src="{{ asset('images/WatchaListo.png') }}" class="logo-img me-2">
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('drama.*') ? 'active' : '' }}"
                        href="{{ route('drama.index') }}">
                            Drama List
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manhwa.*') ? 'active' : '' }}"
                        href="{{ route('manhwa.index') }}">
                            Manhwa List
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Browse
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('browse.index', 'drama') }}">
                                    🎬 Drama
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('browse.index', 'manhwa') }}">
                                    📚 Manhwa
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="dropdown">
                    <a class="text-white dropdown-toggle text-decoration-none"
                    data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark">
                        <li><a class="dropdown-item text-light" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten utama --}}
    <div class="container my-5">
        @isset($header)
            <div class="mb-4">
                {{ $header }}
            </div>
        @endisset

        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>