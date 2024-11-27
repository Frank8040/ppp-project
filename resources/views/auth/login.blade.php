<x-guest-layout>
    <div class="fondo">
        <x-authentication-card>
            <x-slot name="logo">

            </x-slot>

            <div class="flex justify-center">
                <div class="bg-white rounded-full p-4">
                    <img class="w-40 h-40" src="/images/user.png" alt="">
                </div>
            </div>

            <x-validation-errors class="mb-4" />


            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="flex flex-col gap-4">
                    <x-input id="email" icon="envelope" label="{{ __('Email') }}" placeholder="" type="email"
                        name="email" :value="old('email')" required autocomplete="username" />

                    <x-password id="password" icon="lock-closed" label="{{ __('Password') }}" name="password" required
                        autocomplete="current-password" />
                </div>

                {{-- <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div> --}}

                <x-button class="mt-3 bg-[#00345B] w-full" type="submit">
                    Iniciar sesion
                </x-button>

                <div class="flex items-center justify-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            ¿Has olvidado la contraseña?
                        </a>
                    @endif
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
