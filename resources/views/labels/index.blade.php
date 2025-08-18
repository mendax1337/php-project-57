<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('labels.create') }}" class="btn btn-primary mb-4">{{ __('Create label') }}</a>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if(session('error'))
                    <div class="text-red-600">{{ session('error') }}</div>
                @endif
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($labels as $label)
                        <tr>
                            <td>{{ $label->id }}</td>
                            <td>{{ $label->name }}</td>
                            <td>{{ $label->description }}</td>
                            <td>{{ $label->created_at->format('d.m.Y') }}</td>
                            <td>
                                <a href="{{ route('labels.edit', $label) }}">{{ __('Edit') }}</a>
                                <form action="{{ route('labels.destroy', $label) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить метку?')">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $labels->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
