<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Менеджер задач') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-5xl font-extrabold mb-4">Привет от Хекслета!</h1>
                    <p class="text-lg opacity-80">Это простой менеджер задач на Laravel</p>

                    <a href="#"
                       class="inline-block mt-6 px-6 py-3 rounded-md border border-gray-300 dark:border-gray-700">
                        Нажми меня
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
