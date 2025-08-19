<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Статусы</h2>
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

        <div class="mb-4">
            <a href="{{ route('task_statuses.create') }}"
               class="inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700">
                Создать статус
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Имя</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Действия</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($task_statuses as $status)
                    <tr>
                        <td class="px-6 py-4">{{ $status->id }}</td>
                        <td class="px-6 py-4">{{ $status->name }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('task_statuses.edit', $status) }}"
                               class="px-3 py-1 rounded-md border text-gray-700 hover:bg-gray-50">Изменить</a>
                            <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Удалить статус?')"
                                        class="px-3 py-1 rounded-md border text-red-700 hover:bg-red-50">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-6 text-center text-gray-500" colspan="3">Пока нет статусов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $task_statuses->links() }}
        </div>
    </main>
</x-app-layout>
