<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Статусы
        </h2>
    </x-slot>

    <main class="mx-auto max-w-7xl p-6 lg:p-8">
        @include('flash::message')

        <div class="mb-4">
            @auth
                <a href="{{ route('task_statuses.create') }}"
                   class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                    Создать статус
                </a>
            @endauth
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Имя</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата создания</th>
                    @auth
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                    @endauth
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($statuses as $status)
                    <tr>
                        <td class="px-4 py-2">{{ $status->id }}</td>
                        <td class="px-4 py-2">{{ $status->name }}</td>
                        <td class="px-4 py-2">{{ $status->created_at?->format('Y-m-d H:i') }}</td>
                        @auth
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('task_statuses.edit', $status) }}"
                                   class="inline-block px-3 py-1 rounded text-white bg-amber-500 hover:bg-amber-600">
                                    Изменить
                                </a>
                                <form action="{{ route('task_statuses.destroy', $status) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Удалить статус?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 rounded text-white bg-red-600 hover:bg-red-700">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Пока нет статусов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $statuses->links() }}
        </div>
    </main>
</x-app-layout>
