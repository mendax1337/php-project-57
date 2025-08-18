@props(['task' => null, 'statuses', 'users'])

@php
    $t = $task;
@endphp

<div class="space-y-6">
    {{-- name --}}
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', optional($t)->name)"
            required
            autofocus
            autocomplete="name"
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- description --}}
    <div>
        <x-input-label for="description" :value="__('Description')" />
        <textarea
            id="description"
            name="description"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            rows="4"
        >{{ old('description', optional($t)->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    {{-- status_id --}}
    <div>
        <x-input-label for="status_id" :value="__('Status')" />
        <select
            id="status_id"
            name="status_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required
        >
            <option value="" disabled {{ old('status_id', optional($t)->status_id) ? '' : 'selected' }}>
                {{ __('Select status') }}
            </option>
            @foreach($statuses as $id => $name)
                <option value="{{ $id }}" @selected((string) old('status_id', optional($t)->status_id) === (string) $id)>{{ $name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status_id')" />
    </div>

    {{-- assigned_to_id --}}
    <div>
        <x-input-label for="assigned_to_id" :value="__('Executor')" />
        <select
            id="assigned_to_id"
            name="assigned_to_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        >
            <option value="">{{ __('Not assigned') }}</option>
            @foreach($users as $id => $name)
                <option value="{{ $id }}" @selected((string) old('assigned_to_id', optional($t)->assigned_to_id) === (string) $id)>{{ $name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('assigned_to_id')" />
    </div>
</div>
