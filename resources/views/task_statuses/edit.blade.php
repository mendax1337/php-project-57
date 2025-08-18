<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Изменение статуса') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('task_statuses.update', $task_status) }}">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="name" :value="__('Имя')" />
                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('name', $task_status->name)"
                            required
                            autocomplete="off"
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                        <a href="{{ route('task_statuses.index') }}"
                           class="text-gray-600 hover:text-gray-900">
                            {{ __('Отмена') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
