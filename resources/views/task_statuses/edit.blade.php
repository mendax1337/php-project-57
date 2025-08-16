<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать статус
        </h2>
    </x-slot>

    <main class="mx-auto max-w-2xl p-6 lg:p-8">
        @include('flash::message')

        <form method="POST" action="{{ route('task_statuses.update', $status) }}" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                <input type="text" name="name" id="name" value="{{ old('name', $status->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                       required minlength="1" maxlength="255">
                @error('name')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Сохранить
                </button>
                <a href="{{ route('task_statuses.index') }}" class="px-4 py-2 rounded-md border">
                    Отмена
                </a>
            </div>
        </form>
    </main>
</x-app-layout>
