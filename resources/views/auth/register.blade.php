<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex flex-col gap-4">
                <div class="flex justify-between gap-5">
                    <x-input id="name" icon="user" label="{{ __('Nombres') }}" placeholder="" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name" />

                    <x-input id="surnames" icon="user" label="{{ __('Apellidos') }}" placeholder="" type="text"
                        name="surnames" :value="old('surnames')" required autofocus autocomplete="surnames" />
                </div>

                <x-input id="email" icon="envelope" label="{{ __('Email') }}" placeholder="" type="email"
                    name="email" :value="old('email')" required autocomplete="username" />

                <x-input id="code" label="{{ __('Código') }}" placeholder="" type="text" name="code"
                    :value="old('code')" required autocomplete="code" />

                <div class="flex justify-between gap-5">
                    <x-input id="dni" label="{{ __('DNI') }}" placeholder="" type="text" name="dni"
                        :value="old('dni')" required autocomplete="dni" />

                    <x-input id="phone" label="{{ __('Teléfono') }}" placeholder="" type="text" name="phone"
                        :value="old('phone')" required autocomplete="phone" />
                </div>

                <x-password id="password" icon="lock-closed" label="{{ __('Password') }}" name="password" required
                    autocomplete="new-password" />

                <x-password id="password_confirmation" icon="lock-closed" label="{{ __('Confirm Password') }}"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="bg-gray-300 hover:bg-slate-500 ms-4" type="submit">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
