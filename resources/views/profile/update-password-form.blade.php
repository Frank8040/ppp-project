<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="current_password" label="{{ __('Current Password') }}"
                    wire:model="state.current_password" type="password" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="password" label="{{ __('New Password') }}" eye wire:model="state.password"
                    type="password" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="password_confirmation" label="{{ __('Confirm Password') }}"
                    wire:model="state.password_confirmation" type="password" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button-gradient>
            {{ __('Save') }}
        </x-button-gradient>
    </x-slot>
</x-form-section>
