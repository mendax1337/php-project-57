<x-app-layout>
    <x-slot name="header">
        <h2>{{ isset($label) ? __('Edit Label') : __('Create Label') }}</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-8">
        <form method="POST" action="{{ isset($label) ? route('labels.update', $label) : route('labels.store') }}">
            @csrf
            @if(isset($label))
                @method('PUT')
            @endif

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text"
                              class="mt-1 block w-full"
                              :value="old('name', $label->name ?? '')" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="mt-1 block w-full">{{ old('description', $label->description ?? '') }}</textarea>
            </div>

            <div class="mt-4">
                <x-primary-button>{{ isset($label) ? __('Update') : __('Create') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
