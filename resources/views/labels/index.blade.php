<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Метки') }}
            </h2>
            @auth
                <a href="{{ route('labels.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ __('Создать метку') }}
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Описание</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата создания</th>
                            @auth
                                <th class="px-4 py-3"></th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($labels as $label)
                            <tr>
                                <td class="px-4 py-3">{{ $label->id }}</td>
                                <td class="px-4 py-3">{{ $label->name }}</td>
                                <td class="px-4 py-3">{{ $label->description }}</td>
                                <td class="px-4 py-3">{{ $label->created_at?->format('d.m.Y') }}</td>
                                @auth
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('labels.edit', $label) }}"
                                           class="inline-flex items-center px-3 py-1 border rounded-md text-sm text-gray-700 hover:bg-gray-50">
                                            {{ __('Изменить') }}
                                        </a>
                                        <form action="{{ route('labels.destroy', $label) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="ms-2 inline-flex items-center px-3 py-1 border rounded-md text-sm text-red-600 hover:bg-red-50"
                                                    onclick="return confirm('{{ __('Удалить метку?') }}')">
                                                {{ __('Удалить') }}
                                            </button>
                                        </form>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Пока нет меток</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $labels->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
