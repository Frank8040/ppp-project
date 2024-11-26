@props(['hover', 'content' => ''])

@php

    $color = [
        'amber' => 'dark:hover:text-amber-500 hover:text-amber-500 hover:bg-amber-600/10',
        'blue' => 'dark:hover:text-blue-500 hover:text-blue-500 hover:bg-blue-600/10',
        'brown' => 'dark:hover:text-brown-500 hover:text-brown-500 hover:bg-brown-600/10',
        'blue-gray' => 'dark:hover:text-blue-500 hover:text-blue-gray-500 hover:bg-blue-gray-600/10',
        'cyan' => 'dark:hover:text-cyan-500 hover:text-cyan-500 hover:bg-cyan-600/10',
        'deep-orange' => 'dark:hover:text-deep-500 hover:text-deep-orange-500 hover:bg-deep-orange-600/10',
        'deep-purple' => 'dark:hover:text-deep-500 hover:text-deep-purple-500 hover:bg-deep-purple-600/10',
        'gray' => 'dark:hover:text-gray-500 hover:text-gray-600 hover:bg-gray-600/10',
        'green' => 'dark:hover:text-green-500 hover:text-green-500 hover:bg-green-600/10',
        'indigo' => 'dark:hover:text-indigo-500 hover:text-indigo-500 hover:bg-indigo-600/10',
        'lime' => 'dark:hover:text-lime-500 hover:text-lime-500 hover:bg-lime-600/10',
        'light-green' => 'dark:hover:text-light-green-500 hover:text-light-green-500 hover:bg-light-green-600/10',
        'light-blue' => 'dark:hover:text-light-blue-500 hover:text-light-blue-500 hover:bg-light-blue-600/10',
        'orange' => 'dark:hover:text-orange-500 hover:text-orange-500 hover:bg-orange-600/10',
        'purple' => 'dark:hover:text-purple-500 hover:text-purple-500 hover:bg-purple-600/10',
        'pink' => 'dark:hover:text-pink-500 hover:text-pink-500 hover:bg-pink-600/10',
        'red' => 'dark:hover:text-red-500 hover:text-red-500 hover:bg-red-600/10',
        'teal' => 'dark:hover:text-teal-500 hover:text-teal-500 hover:bg-teal-600/10',
        'yellow' => 'dark:hover:text-yellow-500 hover:text-yellow-500 hover:bg-yellow-600/10',
        'default' => 'hover:bg-gray-900/10',
    ][$hover ?? 'default'];
@endphp


<button {{ $attributes->merge(['type' => 'button', 'class' => 'group flex relative p-2.5 select-none rounded-lg text-start align-middle font-sans text-xs font-medium uppercase text-gray-900 dark:text-gray-400  ' . $color . ' transition-all disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none active:bg-gray-300']) }}>
    {{ $slot }}
    <div class="absolute -top-7 left-1/2 transform -translate-x-1/2 px-1.5 py-0.5 rounded-md hidden text-[0.625rem] group-hover:block group-hover:transition-transform group-hover:duration-700 w-max bg-black text-white">
        {{ $content }}
        <span class="tooltip-arrow absolute left-1/2 transform -translate-x-1/2 -bottom-1"></span>
    </div>
</button>


