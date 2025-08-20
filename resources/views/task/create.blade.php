@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.task.create.header') }}</h1>

        {{ html()->form('POST', route('tasks.store'))->class('w-50')->open() }}
            <div class="flex flex-col">
                <x-input-name label="{{ __('views.task.create.name') }}" />
                <x-textarea-description label="{{ __('views.task.create.description') }}" />
                <div class="mt-2">
                    {{ html()->label(__('views.task.create.status'), 'status_id') }}
                </div>
                <div>
                    {{ html()->select('status_id', $taskStatuses, null)->class('rounded border-gray-300 w-1/3')->placeholder(__('views.task.create.placeholder')) }}
                </div>
                @error('status_id')
                    <div class="text-rose-600">{{ $message }}</div>
                @enderror
                <div class="mt-2">
                    {{ html()->label(__('views.task.create.assigned_to'), 'assigned_to_id') }}
                </div>
                <div>
                    {{ html()->select('assigned_to_id', $users, null)->class('rounded border-gray-300 w-1/3')->placeholder(__('views.task.create.placeholder')) }}
                </div>
                <div class="mt-2">
                    {{ html()->label(__('views.task.create.labels'), 'labels') }}
                </div>
                <div>
                    {{ html()->select('labels', $labels)->class('rounded border-gray-300 w-1/3 h-32')->multiple('multiple') }}
                </div>
                <x-submit-button caption="{{ __('views.task.create.button') }}" />
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection
