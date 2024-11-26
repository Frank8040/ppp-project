<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="mb-5 items-center sm:flex 2xl:flex sm:gap-4 2xl:gap-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <!-- Current Profile Photo -->
                <div x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_path ? Storage::url($this->user->profile_photo_path) : $this->user->profile_photo_url }}"
                        alt="{{ $this->user->name }}" class="border-2 rounded-full h-28 w-28 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <div>
                    <h3 class="mb-1 text-xl font-bold text-gray-900">
                        {{ __('Foto de perfil') }}</h3>
                    <div class="mb-2 text-sm text-gray-500">
                        {{ __('JPG, JPEG o PNG. Tamaño máximo de 1MB') }}
                    </div>
                    <div class="flex items-center space-x-4">
                        <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-secondary-button>
                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif

                        <x-input-error for="photo" class="mt-2" />
                    </div>
                </div>
            </div>
        @endif

        <!-- Name -->
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="name" label="{{ __('Name') }}" wire:model.live="state.name" type="text"
                    required />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="surnames" label="{{ __('Apellidos') }}" wire:model.live="state.surnames"
                    type="text" required />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="email" label="{{ __('Email') }}" wire:model.live="state.email" type="email"
                    required />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                        !$this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button type="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="dni" label="DNI" wire:model.live="state.dni"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" type="text" maxlength="8" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-input-label for="phone" label="Número de celular" wire:model.live="state.phone"
                    oninput="formatPhoneNumber(this)" maxlength="11" type="tel" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button-gradient wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button-gradient>
    </x-slot>
</x-form-section>
