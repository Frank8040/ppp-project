@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show"
    id="{{ $id }}"
    class="jetstream-modal fixed inset-0  grid h-screen w-screen place-items-center overflow-y-auto px-4 py-4 sm:px-0 z-50"
    style="display: none;">
    <div x-show="show" class="fixed inset-0 transition-opacity duration-300" x-on:click="show = false"
        wire:click="closeModals" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-black bg-opacity-60 backdrop-blur-sm"></div>
    </div>

    <div x-show="show"
        class="w-full {{ $maxWidth }} max-h-[calc(100vh-2rem)] rounded-lg bg-white shadow-2xl transform transition-all"
        x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-28 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-28 scale-90">
        {{ $slot }}
    </div>
</div>
