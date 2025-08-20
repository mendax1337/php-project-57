<div class="mt-2">
    {{ html()->label(__('views.task.edit.description'), $label) }}
</div>
<div class="mt-2">
    {{ html()->textarea('description')->class('rounded border-gray-300 w-1/3 h-32')->cols('50')->rows('10') }}
</div>
@error('description')
    <div class="text-rose-600">{{ $message }}</div>
@enderror
