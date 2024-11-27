@props(['active'])

@php
    $classes = $active ?? false ? '!text-white font-bold bg-[#00345B]' : 'hover:text-gray-500 hover:bg-gray-200 ';
@endphp

<li class="mb-1 last:mb-0">
    <a
        {{ $attributes->merge(['class' => 'px-3 py-2 block text-gray-600 transition truncate ' . $classes]) }}>
        <div class="flex items-center truncate">
            <i class="fa-regular fa-circle fa-xs fa-fw"></i>
            <span
                class="text-sm ml-3.5 2xl:opacity-100 duration-200">{{ $slot }}</span>
        </div>

    </a>
</li>
