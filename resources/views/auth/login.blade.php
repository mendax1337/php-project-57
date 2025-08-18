{{-- Страница входа --}}
    <!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Вход — Менеджер задач</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-semibold text-center mb-6">Менеджер задач</h1>

        {{-- Сообщение об успехе / статусе (если есть) --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- Ошибки валидации --}}
        @if ($errors->any())
            <div class="mb-4 rounded border border-red-300 bg-red-50 text-red-700 p-3">
                <ul class="list-disc ms-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Войти
                </button>
            </div>
        </form>

        <div class="mt-4 text-center text-sm">
            Нет аккаунта?
            <a class="text-blue-600 hover:underline" href="{{ route('register') }}">Зарегистрироваться</a>
        </div>
    </div>
</div>
</body>
</html>
