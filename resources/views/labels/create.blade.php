@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Создать метку</h1>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc ms-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('labels.store') }}" class="space-y-6 bg-white p-6 rounded-xl shadow">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Имя</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                       class="block w-full rounded-xl border border-blue-200 bg-blue-50/60 px-4 py-2.5
                          shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
                <textarea id="description" name="description" rows="4"
                          class="block w-full rounded-xl border border-gray-300 px-4 py-2.5 shadow-sm
                             focus:border-blue-500 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="inline-flex justify-center items-center px-6 py-2.5 bg-blue-600 text-white rounded-xl
                           hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Создать
                </button>
            </div>
        </form>
    </div>
@endsection
