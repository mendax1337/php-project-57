@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-semibold">Метки</h1>

            @auth
                <a href="{{ route('labels.create') }}"
                   class="px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                    Создать метку
                </a>
            @endauth
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 text-green-800 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Имя</th>
                    <th class="px-6 py-3">Описание</th>
                    <th class="px-6 py-3">Дата создания</th>
                    @auth
                        <th class="px-6 py-3"></th>
                    @endauth
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($labels as $label)
                    <tr>
                        <td class="px-6 py-3">{{ $label->id }}</td>
                        <td class="px-6 py-3">{{ $label->name }}</td>
                        <td class="px-6 py-3">{{ $label->description }}</td>
                        <td class="px-6 py-3">{{ $label->created_at->format('d.m.Y') }}</td>
                        @auth
                            <td class="px-6 py-3 whitespace-nowrap text-right text-sm">
                                <a href="{{ route('labels.edit', $label) }}"
                                   class="text-blue-600 hover:underline me-4">Изменить</a>

                                {{-- Клик по ссылке + confirm() — под Dusk::acceptDialog() --}}
                                <a href="{{ route('labels.destroy', $label) }}"
                                   onclick="event.preventDefault(); if (confirm('Вы уверены?')) document.getElementById('del-{{ $label->id }}').submit();"
                                   class="text-red-600 hover:underline">Удалить</a>
                                <form id="del-{{ $label->id }}" action="{{ route('labels.destroy', $label) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        @endauth
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $labels->links() }}
        </div>
    </div>
@endsection
