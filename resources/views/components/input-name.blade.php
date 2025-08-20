<div>
    {{ html()->label(__('views.task.edit.name'), $label) }}
</div>
<div class="mt-2">
    {{ html()->text('name', null)->class('rounded border-gray-300 w-1/3') }}
</div>
@error('name')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
