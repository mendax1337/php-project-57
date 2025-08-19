{{-- Успех --}}
@if (session('success'))
    <div role="alert" class="mb-4 rounded-lg bg-green-600/20 text-green-200 px-4 py-3">
        {{ session('success') }}
    </div>
@endif

{{-- Ошибка --}}
@if (session('error'))
    <div role="alert" class="mb-4 rounded-lg bg-red-600/20 text-red-200 px-4 py-3">
        {{ session('error') }}
    </div>
@endif

{{-- Сообщения валидации --}}
@if ($errors->any())
    <div role="alert" class="mb-4 rounded-lg bg-red-600/20 text-red-200 px-4 py-3">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
