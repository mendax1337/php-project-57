<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Просмотр задачи') }}: {{ $task->name }}
            </h2>

            @auth
                <a href="{{ route('tasks.edit', $task) }}"
                   class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M13.586 3.586a2 2 0 0 1 2.828 2.828l-8.5 8.5-3.121.293a1 1 0 0 1-1.09-1.09l.293-3.121 8.5-8.5Z"/>
                        <path d="M5 13.5V15h1.5l8.207-8.207-1.5-1.5L5 13.5Z"/>
                    </svg>
                    {{ __('Редактировать') }}
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-lg bg-white p-8 shadow">
                <dl class="space-y-4">
                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Имя') }}:</dt>
                        <dd class="col-span-9 text-gray-900">{{ $task->name }}</dd>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Статус') }}:</dt>
                        <dd class="col-span-9 text-gray-900">{{ $task->status?->name }}</dd>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Автор') }}:</dt>
                        <dd class="col-span-9 text-gray-900">{{ $task->creator?->name }}</dd>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Исполнитель') }}:</dt>
                        <dd class="col-span-9 text-gray-900">
                            {{ $task->assignee?->name ?? __('Не назначен') }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Описание') }}:</dt>
                        <dd class="col-span-9 whitespace-pre-wrap text-gray-900">
                            {{ $task->description ?: __('(нет)') }}
                        </dd>
                    </div>

                    <div class="grid grid-cols-12 gap-4">
                        <dt class="col-span-3 font-semibold text-gray-700">{{ __('Метки') }}:</dt>
                        <dd class="col-span-9">
                            @if($task->labels->isEmpty())
                                <span class="text-gray-500">{{ __('(нет)') }}</span>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach($task->labels as $label)
                                        <x-ui.label-badge :text="$label->name" />
                                    @endforeach
                                </div>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
