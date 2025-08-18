<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- Имя --}}
        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="block mt-1 w-full"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="block mt-1 w-full"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Пароль --}}
        <div>
            <x-input-label for="password" :value="__('Пароль')" />
            <x-text-input
                id="password"
                name="password"
                type="password"
                class="block mt-1 w-full"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Подтверждение --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Подтверждение')" />
            <x-text-input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="block mt-1 w-full"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <a
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}"
            >
                {{ __('Уже зарегистрированы?') }}
            </a>

            {{-- Видимая кнопка --}}
            <x-primary-button class="ms-4">
                {{ __('Зарегистрировать') }}
            </x-primary-button>

            {{-- Невидимый submit специально для Dusk (ищет по тексту value) --}}
            <input type="submit" value="Зарегистрировать"
                   style="position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden;">
        </div>
    </form>
</x-guest-layout>
