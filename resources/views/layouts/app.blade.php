<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
<div class="min-h-screen">
    @include('layouts.navigation')

    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{-- флеши, если нужны глобально --}}
        @include('flash-message')
        {{-- сюда отрисуется контент страниц --}}
        @yield('content')
    </main>
</div>
</body>
</html>
