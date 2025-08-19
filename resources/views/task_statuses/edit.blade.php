<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изменить статус</h2>
    </x-slot>

    <main class="mx-auto max-w-7xl p-6 lg:p-8">

        {{-- flash messages --}}
        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-50 p-3 text-green-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-50 p-3 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('task_statuses.update', $task_status) }}">
                @csrf
                @method('PATCH')

                <div>
                    <x-input-label for="name" :value="__('Имя')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                  :value="old('name', $task_status->name)" required autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-6 flex items-center gap-3">
                    <x-primary-button>Обновить</x-primary-button>
                    <a href="{{ route('task_statuses.index') }}" class="text-gray-600 hover:text-gray-900">Отмена</a>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>
