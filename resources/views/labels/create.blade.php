<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создать метку') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('labels.store') }}" class="space-y-6">
                        @csrf
                        <x-labels.form :label="null" />
                        <div class="flex items-center gap-3">
                            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
                            <a href="{{ route('labels.index') }}" class="text-gray-600 hover:text-gray-800">{{ __('Отмена') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
