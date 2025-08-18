@props(['label' => null])

@php
    /** @var \App\Models\Label|null $l */
    $l = $label;
@endphp

<div class="space-y-6">
    {{-- Имя --}}
    <div>
        <x-input-label for="name" :value="__('Имя')" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', optional($l)->name)"
            required
            autofocus
            autocomplete="off"
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
        >{{ old('description', optional($l)->description) }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>
</div>
