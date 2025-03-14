<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan dan Saran Desa Kalisube</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
    <div class="container">
        <!-- Header -->
        <header>
            @if (Route::has('login'))
                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="button-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="button-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="button-primary">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main Content -->
        <main class="main-content animated">
            <h1>Selamat Datang di Sistem Pengaduan dan Saran Desa Kalisube</h1>
            <p>
                Website ini bertujuan untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran
                terkait pembangunan dan pelayanan di Desa Kalisube.
            </p>
            <a href="{{ route('login') }}" class="button-primary">Mulai Pengaduan</a>
        </main>
    </div>
</body>
</html>