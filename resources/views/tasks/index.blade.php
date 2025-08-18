<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Задачи') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Форма фильтра --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="get" action="{{ route('tasks.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-end">
                    {{-- Статус --}}
                    <div class="sm:flex-1">
                        <x-input-label for="filter_status" :value="__('Статус')" />
                        <select
                            id="filter_status"
                            name="filter[status_id]"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        >
                            @php $selectedStatus = request('filter.status_id'); @endphp
                            <option value="">{{ __('Статус') }}</option>
                            @foreach($statuses as $id => $name)
                                <option value="{{ $id }}" @selected((string)$selectedStatus === (string)$id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Автор --}}
                    <div class="sm:flex-1">
                        <x-input-label for="filter_author" :value="__('Автор')" />
                        <select
                            id="filter_author"
                            name="filter[created_by_id]"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        >
                            @php $selectedAuthor = request('filter.created_by_id'); @endphp
                            <option value="">{{ __('Автор') }}</option>
                            @foreach($users as $id => $name)
                                <option value="{{ $id }}" @selected((string)$selectedAuthor === (string)$id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Исполнитель --}}
                    <div class="sm:flex-1">
                        <x-input-label for="filter_assignee" :value="__('Исполнитель')" />
                        <select
                            id="filter_assignee"
                            name="filter[assigned_to_id]"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                        >
                            @php $selectedAssignee = request('filter.assigned_to_id'); @endphp
                            <option value="">{{ __('Исполнитель') }}</option>
                            @foreach($users as $id => $name)
                                <option value="{{ $id }}" @selected((string)$selectedAssignee === (string)$id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:w-auto">
                        <x-primary-button class="w-full sm:w-auto">
                            {{ __('Применить') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- Кнопка создать --}}
            @auth
                <div class="flex justify-end">
                    <a href="{{ route('tasks.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none transition">
                        {{ __('Новая задача') }}
                    </a>
                </div>
            @endauth

            {{-- Таблица задач --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">{{ __('Статус') }}</th>
                            <th class="px-3 py-2">{{ __('Имя') }}</th>
                            <th class="px-3 py-2">{{ __('Автор') }}</th>
                            <th class="px-3 py-2">{{ __('Исполнитель') }}</th>
                            <th class="px-3 py-2">{{ __('Дата создания') }}</th>
                            @auth
                                <th class="px-3 py-2"></th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($tasks as $task)
                            <tr class="text-sm text-gray-700">
                                <td class="px-3 py-2">{{ $task->id }}</td>
                                <td class="px-3 py-2">{{ $task->status?->name }}</td>
                                <td class="px-3 py-2">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:underline">
                                        {{ $task->name }}
                                    </a>
                                </td>
                                <td class="px-3 py-2">{{ $task->creator?->name }}</td>
                                <td class="px-3 py-2">{{ $task->assignee?->name }}</td>
                                <td class="px-3 py-2">{{ $task->created_at?->format('d.m.Y') }}</td>
                                @auth
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline mr-3">{{ __('Изменить') }}</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="post" class="inline"
                                              onsubmit="return confirm('{{ __('Удалить задачу?') }}')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="text-red-600 hover:underline">{{ __('Удалить') }}</button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td class="px-3 py-4 text-center text-gray-500" colspan="7">{{ __('Ничего не найдено') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
