@props(['role'])

@php

    $colorRole = [
        '1' => 'rounded-md text-green-500 bg-green-500/20',
        '2' => 'rounded-md text-blue-500 bg-blue-500/20',
        '3' => 'rounded-md text-orange-500 bg-orange-500/20',
        '4' => 'rounded-md text-indigo-500 bg-indigo-500/20',
        '5' => 'rounded-md text-brown-500 bg-brown-500/20',
        '6' => 'rounded-md text-purple-500 bg-purple-500/20',
        '7' => 'rounded-md text-gray-600 bg-gray-500/20',
        'null' => 'rounded-md text-red-500 bg-red-500/20',
        '' => '',
    ][$role ?? ''];
@endphp

<span {{ $attributes->merge(['class' => 'px-2 py-1 text-xs font-bold uppercase ' . $colorRole . ' ']) }}>
    {{ $slot }}
</span>
