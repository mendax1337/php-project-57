<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen antialiased">
@include('layouts.navigation')

<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Флеши/валидация --}}
    @includeIf('partials.flash-message')

    {{-- Контент страницы --}}
    @yield('content')
</main>
</body>
</html>
