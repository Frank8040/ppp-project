@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="my-4 border"></div>

    <div class="">
        <form wire:submit="{{ $submit }}">
            <div class="2xl:col-span-2">
                {{ $form }}
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-start mt-4 text-end">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
