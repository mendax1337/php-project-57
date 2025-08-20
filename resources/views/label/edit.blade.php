@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.label.edit.header') }}</h1>

        {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->class('w-50')->open() }}
            <div class="flex flex-col">
                <x-input-name label="{{ __('views.label.edit.name') }}" />
                <x-textarea-description label="{{ __('views.label.edit.description') }}" />
                <x-submit-button caption="{{ __('views.label.edit.button') }}" />
            </div>
        {{ html()->closeModelForm() }}
    </div>
@endsection
