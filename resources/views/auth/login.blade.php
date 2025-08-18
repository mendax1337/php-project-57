<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Вход — Менеджер задач</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<main class="min-h-screen flex items-center justify-center py-12 px-4">
    <section class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h1 class="text-4xl font-semibold text-center mb-8">Менеджер задач</h1>

            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                    <ul class="list-disc ms-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                               shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                    <input
                        id="password" name="password" type="password" required autocomplete="current-password"
                        class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                               shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="remember"
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        Запомнить меня
                    </label>

                    <a href="{{ route('password.request') }}"
                       class="text-sm text-blue-600 hover:underline">Забыли пароль?</a>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 text-white
                                   rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2
                                   focus:ring-offset-2 focus:ring-blue-500">
                        Войти
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                Нет аккаунта?
                <a class="text-blue-600 hover:underline" href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        </div>
    </section>
</main>
</body>
</html>
