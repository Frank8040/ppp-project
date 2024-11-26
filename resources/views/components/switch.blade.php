@props(['option' => false, 'left' => 'izquierda', 'right' => 'derecha'])

<div class="flex items-center gap-2">
    <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="{{ $option }}">

    <label :class="{{ $option }} ? 'text-gray-400' : 'text-red-500'" class="text-sm select-none">
        {{ $left }}
    </label>

    <button type="button" :class="{{ $option }} ? 'bg-green-600' : 'bg-red-500'"
        {{ $attributes->merge(['class' => 'relative inline-flex h-6 py-0.5 focus:outline-none rounded-full w-10']) }}>
        <span :class="{{ $option }} ? 'translate-x-[18px]' : 'translate-x-0.5'"
            class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
    </button>

    <label :class="{{ $option }} ? 'text-green-600' : 'text-gray-400'" class="text-sm select-none">
        {{ $right }}
    </label>
</div>
