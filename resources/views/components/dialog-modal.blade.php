@props(['id' => null, 'maxWidth' => null])

<x-modal-content :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div
        class="flex items-center px-4 h-14 font-sans text-base antialiased font-semibold leading-snug shrink-0 text-blue-gray-900">
        {{ $title }}
    </div>
    <div
        class="overflow-y-auto max-h-[calc(100vh-9rem)] p-4 border-t border-b border-t-blue-gray-100 border-b-blue-gray-100 text-sm">
        {{ $content }}
    </div>
    <div class="flex flex-wrap items-center justify-end px-4 h-14 shrink-0">
        {{ $footer }}
    </div>
</x-modal-content>
