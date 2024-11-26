@props(['active'])

@php
    $classes = $active ?? false ? '!text-blue-600 font-bold' : '';
@endphp

<li class="mb-1 last:mb-0">
    <a
        {{ $attributes->merge(['class' => 'block text-gray-400 dark:text-gray-400 hover:text-blue-500 dark:hover:text-gray-200 transition truncate ' . $classes]) }}>
        <div class="flex items-center truncate">
            <i class="fa-regular fa-circle fa-xs fa-fw"></i>
            <span
                class="text-sm ml-3.5 2xl:opacity-100 duration-200">{{ $slot }}</span>
        </div>

    </a>
</li>
