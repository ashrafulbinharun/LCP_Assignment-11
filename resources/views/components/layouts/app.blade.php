<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <title>{{ $title ?? 'Page Title' }} | {{ config('app.name', 'Barta') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <x-navbar />

    <main class="container max-w-xl min-h-screen px-2 mx-auto mt-8 space-y-8 md:px-0">
        @if (session()->has('message'))
            <div class="flex items-center justify-center p-4 mb-4 text-sm font-medium text-green-800 border-2 border-green-300 rounded-lg bg-green-50" role="alert">
                <span class="sr-only">Success</span>
                <div class="text-center">{{ session('message') }}</div>
            </div>
        @endif

        {{ $slot }}
    </main>
    <x-footer />
</body>

</html>
