@props(['disabled' => false, 'selected' => null, 'value' => null, 'label' => 'Texto', 'for' => ''])

<div x-data="{ open: false, containerWidth: 240, selected: @entangle($attributes->wire('model')).defer }" x-cloak>
    <div {{ $attributes->merge(['class' => 'relative h-10 w-full']) }} x-ref="container" x-init="$nextTick(() => containerWidth = $refs.container.offsetWidth)">
        <button @click="open = !open;" type="button" {{ $disabled ? 'disabled' : '' }}
            class="peer relative w-full h-full flex items-center pr-9 text-left rounded-md border border-gray-400 border-t-transparent bg-transparent p-3 font-sans text-sm font-normal text-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-gray-400 placeholder-shown:border-t-gray-400 focus:border-gray-900 focus:border-t-transparent focus:ring-0 focus:outline-0 disabled:bg-gray-100 disabled:text-gray-700">
            <span
                x-text="selected ? '{{ $value }}': ('{{ $selected }}' != '' ? '{{ $selected }}' : '{{ $value }}')"
                class="block truncate"></span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fa-solid fa-chevron-down fa-xs"></i>
            </span>
        </button>

        <label
            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-xs font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-gray-400 before:transition-all after:pointer-events-none after:mt-[6px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-gray-400 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-gray-600 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-xs peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-gray-900 peer-focus:after:border-gray-900 peer-disabled:peer-placeholder-shown:text-gray-600">
            {{ $label }}
        </label>

        <ul x-show="open" @click.away="open = false" :style="{ minWidth: containerWidth + 'px' }"
            class="fixed z-40 mt-1 max-h-52 overflow-auto rounded-lg bg-white text-base shadow-xl sm:text-sm border">
            {{ $options }}
        </ul>
    </div>
    @unless (!empty(${$for}))
        @error($for)
            <div class="text-red-500 text-xs mt-1">
                {{ $message }}
            </div>
        @enderror
    @endunless
</div>
