@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.task_status.edit.header') }}</h1>

        {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->class('w-50')->open() }}
            <div class="flex flex-col">
                <x-input-name label="{{ __('views.task_status.edit.name') }}" />
                <x-submit-button caption="{{ __('views.task_status.edit.button') }}" />
            </div>
        {{ html()->closeModelForm() }}
    </div>
@endsection
