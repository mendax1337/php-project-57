@props(['task' => null, 'statuses' => [], 'users' => [], 'labels' => []])

@php
    /** @var \App\Models\Task|null $t */
    $t = $task;
    $selectedLabels = collect(old('labels', optional($t)->labels?->pluck('id')->all() ?? []))
        ->map(fn($v) => (string) $v)
        ->all();
@endphp

<div class="space-y-6">
    {{-- Название --}}
    <div>
        <x-input-label for="name" :value="__('Название')" />
        <input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            value="{{ old('name', optional($t)->name) }}"
            required
            autofocus
            autocomplete="name"
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- Описание --}}
    <div>
        <x-input-label for="description" :value="__('Описание')" />
        <textarea
            id="description"
            name="description"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            rows="4"
        >{{ old('description', optional($t)->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    {{-- Статус --}}
    <div>
        <x-input-label for="status_id" :value="__('Статус')" />
        <select
            id="status_id"
            name="status_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required
        >
            <option value="" disabled {{ old('status_id', optional($t)->status_id) ? '' : 'selected' }}>
                {{ __('Выберите статус') }}
            </option>
            @foreach($statuses as $id => $name)
                <option value="{{ $id }}" @selected((string) old('status_id', optional($t)->status_id) === (string) $id)>{{ $name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status_id')" />
    </div>

    {{-- Исполнитель --}}
    <div>
        <x-input-label for="assigned_to_id" :value="__('Исполнитель')" />
        <select
            id="assigned_to_id"
            name="assigned_to_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
        >
            <option value="">{{ __('Не назначен') }}</option>
            @foreach($users as $id => $name)
                <option value="{{ $id }}" @selected((string) old('assigned_to_id', optional($t)->assigned_to_id) === (string) $id)>{{ $name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('assigned_to_id')" />
    </div>

    {{-- Метки --}}
    <div>
        <x-input-label for="labels" :value="__('Метки')" />
        <select
            id="labels"
            name="labels[]"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            multiple
        >
            @foreach($labels as $id => $name)
                <option value="{{ $id }}" @selected(in_array((string) $id, $selectedLabels, true))>{{ $name }}</option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('labels')" />
    </div>
</div>
