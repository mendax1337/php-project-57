<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Метки') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-4">
                <div></div>
                @auth
                    <a href="{{ route('labels.create') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                        {{ __('Создать метку') }}
                    </a>
                @endauth
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Имя') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Описание') }}</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Дата создания') }}</th>
                                @auth
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Действия') }}</th>
                                @endauth
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($labels as $label)
                                <tr>
                                    <td class="px-4 py-2">{{ $label->id }}</td>
                                    <td class="px-4 py-2">{{ $label->name }}</td>
                                    <td class="px-4 py-2">{{ $label->description }}</td>
                                    <td class="px-4 py-2">{{ $label->created_at->format('d.m.Y') }}</td>
                                    @auth
                                        <td class="px-4 py-2 text-right">
                                            <a href="{{ route('labels.edit', $label) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                {{ __('Изменить') }}
                                            </a>
                                            <form action="{{ route('labels.destroy', $label) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('{{ __('Точно удалить метку?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    {{ __('Удалить') }}
                                                </button>
                                            </form>
                                        </td>
                                    @endauth
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        {{ __('Метки пока не созданы') }}
                                    </td>
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
    </div>
</x-app-layout>
