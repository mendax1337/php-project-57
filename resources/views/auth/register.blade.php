<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Регистрация — Менеджер задач</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<main class="min-h-screen flex items-center justify-center py-12 px-4">
    <section class="w-full max-w-xl">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h1 class="text-4xl font-semibold text-center mb-8">Менеджер задач</h1>

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                    <ul class="list-disc ms-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
                    <input
                        id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                               shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                        class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                               shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Пароль</label>
                        <input
                            id="password" name="password" type="password" required autocomplete="new-password"
                            class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                                   shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    <div>
                        <label for="password_confirmation"
                               class="block text-sm font-medium text-gray-700 mb-1">Подтверждение</label>
                        <input
                            id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                                   shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 text-white
                                   rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2
                                   focus:ring-offset-2 focus:ring-blue-500">
                        Зарегистрировать
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm">
                Уже зарегистрированы?
                <a class="text-blue-600 hover:underline" href="{{ route('login') }}">Войти</a>
            </div>
        </div>
    </section>
</main>
</body>
</html>
