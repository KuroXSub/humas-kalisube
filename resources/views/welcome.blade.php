<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengaduan dan Saran Desa Kalisube</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18]">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Sistem Pengaduan Desa Kalisube</h1>
            @if (Route::has('login'))
                <nav class="flex gap-4">
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
        <main class="mb-12">
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Selamat Datang</h2>
                <p class="mb-4">
                    Website ini bertujuan untuk memudahkan masyarakat dalam menyampaikan pengaduan dan saran
                    terkait pembangunan dan pelayanan di Desa Kalisube.
                </p>
                <a href="{{ route('login') }}" class="button-primary">Mulai Pengaduan</a>
            </div>

            <!-- Daftar File -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Dokumen Publik Desa</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe File</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Upload</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($files as $file)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $file->title }}</td>
                                <td class="px-6 py-4">{{ Str::limit($file->description, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ strtoupper($file->file_type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $file->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('file.show', $file) }}" class="text-indigo-600 hover:text-indigo-900">Download</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada dokumen tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($files->hasPages())
                <div class="mt-4">
                    {{ $files->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>