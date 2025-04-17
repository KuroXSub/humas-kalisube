<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <link href="{{ asset('css/navigation.css') }}" rel="stylesheet">
        <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
        <link href="{{ asset('css/settings-navigation.css') }}" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col min-h-screen">
            <header class="bg-gray-800 text-white">
                @include('layouts.navigation')
            </header>

            <main class="flex-1">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 bg-white dark:bg-zinc-800">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        @fluxScripts
    </body>
</html>