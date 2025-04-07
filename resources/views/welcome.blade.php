<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan dan Saran Desa Kalisube</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="{{ asset('css/files.css') }}" rel="stylesheet">
    <link href="{{ asset('css/decrypt.css') }}" rel="stylesheet">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a]">
    <div class="container">
        <header>
            <h1 class="text-2xl font-bold hidden">Sistem Pengaduan Desa Kalisube</h1>
            @if (Route::has('login'))
                <nav class="flex gap-4 items-center">
                    @auth
                        <a href="{{ route('files.index') }}" class="ml-2 header-button">Lihat Dokumen</a>
                        <a href="{{ url('/dashboard') }}" class="button-primary">Dashboard</a>
                    @else
                        <a href="{{ route('files.index') }}" class="ml-2 header-button">Lihat Dokumen</a>
                        <a href="{{ route('login') }}" class="button-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="button-primary ml-2">Register</a>
                        @endif
                    @endauth
                </nav>
            @else
                <nav class="flex gap-4">
                    <a href="{{ route('files.index') }}" class="header-button">Lihat Dokumen</a>
                </nav>
            @endif
        </header>

        <main class="main-content animated">
            <h1>Sistem Pengaduan Desa Kalisube</h1>
            <p>
                Website ini bertujuan untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran
                terkait pembangunan dan pelayanan di Desa Kalisube.
            </p>
            <a href="{{ route('login') }}" class="button-primary">Mulai Pengaduan</a>
        </main>
    </div>
</body>
</html>