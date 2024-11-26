<x-app-layout>
    @section('header', __('Administrar'))
    @section('section', __('Perfil personal'))

    <div>
        <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4">
            <div class="col-span-2 space-y-4">
                <x-app.card>
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
                    @endif
                </x-app.card>

                <x-app.card>
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        @livewire('profile.update-password-form')
                    @endif
                </x-app.card>
            </div>

            <div class="col-span-full xl:col-auto space-y-4">
                <x-app.card class="2xl:col-span-2">
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        @livewire('profile.two-factor-authentication-form')
                    @endif
                </x-app.card>

                <x-app.card class="2xl:col-span-2">
                    @livewire('profile.logout-other-browser-sessions-form')
                </x-app.card>
            </div>
        </div>
    </div>
</x-app-layout>
