<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Изменить задачу</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PATCH')

                    <x-tasks.form :task="$task" :statuses="$statuses" :users="$users" :labels="$labels" />

                    <div class="mt-6 flex items-center gap-3">
                        <x-primary-button>Обновить</x-primary-button>
                        <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-md border">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
