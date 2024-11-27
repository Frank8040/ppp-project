@props(['active', 'icon', 'message' => null])

@php
    $classes = $active ? 'font-bold !text-white bg-[#00345B]' : 'hover:text-gray-600 hover:bg-gray-200 dark:hover:text-white group';
    $classIcon = $icon ? $icon : 'fa-solid fa-question';
@endphp

<a
    {{ $attributes->merge(['class' => 'block text-gray-500 px-3 py-2 group truncate transition ' . $classes]) }}>
    <div class="flex items-center justify-between">
        <div class="flex items-center lg:mx-auto lg:sidebar-expanded:mx-0">
            <span
                class="@if ($active) {{ 'text-white' }}@else{{ ' duration-500' }} @endif">
                <i class="{{ $classIcon }} fa-fw"></i>
            </span>
            <span
                class="text-sm ml-3 lg:hidden lg:sidebar-expanded:block 2xl:opacity-100 duration-200">{{ $slot }}</span>
        </div>
        <!-- Badge -->
        @if ($message)
            <div class="flex flex-shrink-0 ml-2 lg:hidden lg:sidebar-expanded:flex">
                <span
                    class="inline-flex items-center justify-center h-5 text-xs font-medium text-white bg-red-600 px-2 rounded">4</span>
            </div>
        @endif
    </div>
</a>
