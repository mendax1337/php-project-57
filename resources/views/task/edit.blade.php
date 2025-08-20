@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.task.edit.header') }}</h1>

        {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->class('w-50')->open() }}
            <div class="flex flex-col">
                <x-input-name label="{{ __('views.task.edit.name') }}" />
                <x-textarea-description label="{{ __('views.task.edit.description') }}" />
                <div class="mt-2">
                    {{ html()->label(__('views.task.edit.status'), 'status_id') }}
                </div>
                <div>
                    {{ html()->select('status_id', $taskStatuses)->class('rounded border-gray-300 w-1/3') }}
                </div>
                @error('status_id')
                    <div class="text-rose-600">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    {{ html()->label(__('views.task.edit.assigned_to'), 'assigned_to_id') }}
                </div>
                <div>
                    {{ html()->select('assigned_to_id', $users)->class('rounded border-gray-300 w-1/3') }}
                </div>
                <div class="mt-2">
                    
                    {{ html()->label(__('views.task.edit.labels'), 'labels') }}
                </div>
                <div>
                    {{ html()->select('labels', $labels)->class('rounded border-gray-300 w-1/3 h-32')->multiple('multiple') }}
                </div>
                <x-submit-button caption="{{ __('views.task.edit.button') }}" />
            </div>
        {{ html()->closeModelForm() }}
    </div>
@endsection
