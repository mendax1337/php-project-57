<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $task->name }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded shadow">
                <dl class="divide-y divide-gray-200">
                    <div class="py-2 flex justify-between">
                        <dt class="text-gray-500">{{ __('Status') }}</dt>
                        <dd>{{ $task->status?->name }}</dd>
                    </div>
                    <div class="py-2 flex justify-between">
                        <dt class="text-gray-500">{{ __('Author') }}</dt>
                        <dd>{{ $task->creator?->name }}</dd>
                    </div>
                    <div class="py-2 flex justify-between">
                        <dt class="text-gray-500">{{ __('Executor') }}</dt>
                        <dd>{{ $task->assignee?->name ?? '—' }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-gray-500 mb-1">{{ __('Description') }}</dt>
                        <dd class="whitespace-pre-line">{{ $task->description ?: '—' }}</dd>
                    </div>
                </dl>
            </div>

            <div>
                <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">{{ __('Back to list') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
