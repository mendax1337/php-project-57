@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.label.create.header') }}</h1>

        {{ html()->form('POST', route('labels.store'))->class('w-50')->open() }}
            <div class="flex flex-col">
                <x-input-name label="{{ __('views.label.create.name') }}" />
                <x-textarea-description label="{{ __('views.label.create.description') }}" />
                <x-submit-button caption="{{ __('views.label.create.button') }}" />
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection
