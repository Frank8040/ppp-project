<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="my-4 border"></div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="">
            {{ $content }}
        </div>
    </div>
</div>
