@props(['text'])

<span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800 ring-1 ring-inset ring-blue-300">
    {{-- Иконка «тег» --}}
    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
        <path fill-rule="evenodd" d="M17.707 10.293 9.707 2.293A1 1 0 0 0 9 2H4a2 2 0 0 0-2 2v5a1 1 0 0 0 .293.707l8 8a1 1 0 0 0 1.414 0l6-6a1 1 0 0 0 0-1.414ZM6 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" clip-rule="evenodd"/>
    </svg>
    <span class="uppercase tracking-wide">{{ $text }}</span>
</span>
