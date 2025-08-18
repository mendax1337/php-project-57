<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Задачи') }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
            @endif

            @auth
                <div class="mb-4">
                    <a href="{{ route('tasks.create') }}" class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Новая задача') }}
                    </a>
                </div>
            @endauth

            <div class="bg-white shadow-sm rounded">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Name') }}</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Author') }}</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Executor') }}</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tasks as $task)
                        <tr>
                            <td class="px-4 py-2">{{ $task->id }}</td>
                            <td class="px-4 py-2">
                                <a class="text-blue-600 hover:underline" href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
                            </td>
                            <td class="px-4 py-2">{{ $task->status?->name }}</td>
                            <td class="px-4 py-2">{{ $task->creator?->name }}</td>
                            <td class="px-4 py-2">{{ $task->assignee?->name ?? '—' }}</td>
                            <td class="px-4 py-2 text-right">
                                @auth
                                    <a class="text-sm text-indigo-600 hover:underline me-3" href="{{ route('tasks.edit', $task) }}">{{ __('Edit') }}</a>

                                    @can('delete', $task)
                                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:underline"
                                                    onclick="return confirm('Удалить задачу?')"
                                            >{{ __('Delete') }}</button>
                                        </form>
                                    @endcan
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
