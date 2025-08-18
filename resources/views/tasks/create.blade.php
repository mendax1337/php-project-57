<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создать задачу') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    <x-tasks.form :task="null" :statuses="$statuses" :users="$users" :labels="$labels" />

                    <div class="mt-6">
                        <x-primary-button>{{ __('Создать задачу') }}</x-primary-button>
                        <a href="{{ route('tasks.index') }}" class="ms-2 inline-flex items-center px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50">
                            {{ __('Отмена') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
