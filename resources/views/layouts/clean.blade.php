<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login Page' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-indigo-200 dark:from-zinc-950 dark:to-zinc-900 min-h-screen flex items-center justify-center">
    {{ $slot }}
    @fluxScripts
</body>
</html>
