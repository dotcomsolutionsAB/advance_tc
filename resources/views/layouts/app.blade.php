<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles (optional) -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa; /* Light background */
        }
        .navbar {
            background-color: #ffffff; /* White background for the navbar */
            border-bottom: 1px solid #dee2e6; /* Subtle shadow */
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0d6efd; /* Bootstrap primary color */
        }
        .navbar-nav .nav-link {
            color: #495057; /* Darker text color */
        }
        .navbar-nav .nav-link:hover {
            color: #0d6efd; /* Primary color on hover */
        }
        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .dropdown-item:hover {
            background-color: #f1f1f1; /* Light hover effect */
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler:focus {
            outline: none;
            box-shadow: none;
        }
        .main-content {
            padding: 2rem;
        }
        footer {
            background-color: #0d6efd;
            color: #fff;
            /* padding: 1rem; */
            text-align: center;
            position: fixed;
            /* left: 0; */
            padding-top: 12px;
            bottom: 0;
            width: 100%;
            /* background-color: red; */
            text-align: center;
        }
    </style>
    {{-- <style>
                /* Loading animation styles */
                .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent background */
            backdrop-filter: blur(10px); /* Blur effect */
            color: #9d9e9f;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }
        .word {
            font-family: 'Anton', sans-serif;
            perspective: 1000px;
        }
        .word span {
            display: inline-block;
            font-size: 60px;
            font-weight:bolder;
            user-select: none;
            line-height: .8;
        }

        .word span:nth-child(1).active { animation: balance 1.5s ease-out; transform-origin: bottom left; }
        @keyframes balance { 0%, 100% { transform: rotate(0deg); } 30%, 60% { transform: rotate(-45deg); } }

        .word span:nth-child(2).active { animation: shrinkjump 1s ease-in-out; transform-origin: bottom center; }
        @keyframes shrinkjump { 10%, 35% { transform: scale(2, .2); } 45%, 50% { transform: scale(1) translate(0, -150px); } }

        .word span:nth-child(3).active { animation: falling 2s ease-out; transform-origin: bottom center; }
        @keyframes falling { 12% { transform: rotateX(240deg); } 60%, 85% { transform: rotateX(180deg); } }

        .word span:nth-child(4).active { animation: rotate 1s ease-out; }
        @keyframes rotate { 20%, 80% { transform: rotateY(180deg); } 100% { transform: rotateY(360deg); } }

        .word span:nth-child(5).active { animation: toplong 1.5s linear; }
        @keyframes toplong { 10%, 40% { transform: translateY(-48vh); } 90% { transform: translateY(-48vh) scaleY(4); } }
    </style> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- For datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap4.css">

</head>
<body>
    <div id="app">
        <!-- Loading Screen -->
        @include('loading');

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
                        <!-- Add any left navbar content here -->
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
                                    {{ Auth::user()->username }} <!-- Show username -->
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i> {{ __('Logout') }}
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

        <!-- Main Content -->
        <main class="main-content py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const spans = document.querySelectorAll('.word span');
        spans.forEach((span, idx) => {
            setTimeout(() => {
                span.classList.add('active');
            }, 750 * (idx+1));
        });

        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loadingScreen').classList.add('hidden');
            }, 2000); // Ensure at least 2 seconds of loading screen
        });
    </script>

    {{-- script for data tables --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap4.js"></script>
</body>
</html>
