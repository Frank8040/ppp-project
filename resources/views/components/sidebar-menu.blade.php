@props(['active', 'icon'])

@php
    $classes = $active ? 'font-bold !text-black' : 'hover:text-gray-100 dark:hover:text-white group';
    $classIcon = $icon ? $icon : 'fa-solid fa-question';
@endphp

<a {{ $attributes->merge(['class' => 'block text-gray-300 dark:text-gray-300 transition hover:cursor-pointer ' . $classes]) }}>
    <div class="flex items-center justify-between">
        <div class="flex items-center truncate lg:mx-auto lg:sidebar-expanded:mx-0">
            <span
                class="@if ($active) {{ 'text-blue-600' }}@else{{ 'text-gray-300 dark:text-gray-500 group-hover:text-gray-100 group-hover:dark:text-gray-100 duration-500' }} @endif">
                <i class="{{ $classIcon }} fa-fw"></i>
            </span>

            <span
                class="text-sm ml-3 lg:hidden lg:sidebar-expanded:block 2xl:opacity-100 duration-200 truncate">{{ $slot }}</span>
        </div>
        <!-- Icon -->
        <div class="flex shrink-0 ml-2 lg:hidden lg:sidebar-expanded:flex 2xl:opacity-100 duration-200">

            <span class="ml-1 text-gray-400 dark:text-gray-500" :class="open ? 'rotate-180' : 'rotate-0'">
                <i class="fa-solid fa-chevron-down fa-xs @if ($active) {{ 'rotate-0' }} @endif"></i>
            </span>
        </div>
    </div>
</a>
