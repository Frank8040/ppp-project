<div class="sticky z-10 top-0 h-16 border-b bg-white w-full flex items-center px-5">
    <div class="flex items-center justify-between w-full">
        <div class="flex gap-4">

            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                type="button"
                class="flex items-center justify-center w-10 h-10 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                <i class="fa-solid fa-bars-staggered fa-lg"></i>
            </button>

            @php
                $hour = date('H');
            @endphp

            <div class="hidden lg:flex items-center">
                @if ($hour >= 0 && $hour < 12)
                    <b>{{ __('Buenos días') }} 👋!</b>
                @elseif ($hour >= 12 && $hour < 18)
                    <b>{{ __('Buenas tardes') }} 👋!</b>
                @else
                    <b>{{ __('Buenas noches') }} 👋!</b>
                @endif
            </div>

        </div>
        <div class="flex items-center gap-2">
            <a href="#"
                class="flex items-center justify-center w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                <i class="fa-solid fa-globe"></i>
            </a>
            <button aria-label="notification"
                class="w-10 h-10 rounded-xl border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                <i class="fa-solid fa-bell"></i>
            </button>

            <div class="sm:flex sm:items-center">
                <!-- Settings Dropdown -->
                <div class="relative h-10 w-10">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex">
                                <button aria-label="user"
                                    class="relative items-center rounded-full border bg-gray-100 focus:bg-gray-100 active:bg-gray-200">
                                    @if (Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                            alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover">
                                    @else
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @endif
                                    <span
                                        class="absolute bottom-0 right-0 p-1 border-white border-2 bg-green-600 rounded-full"></span>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="px-4 py-2 bg-gray-100">
                                <div
                                    class="font-medium text-sm text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ Auth::user()->name }} {{ Auth::user()->surnames }}</div>
                                <div
                                    class="font-medium text-xs text-gray-500 whitespace-nowrap overflow-hidden text-ellipsis">
                                    {{ Auth::user()->email }}</div>
                            </div>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar Cuenta') }}
                            </div>

                            <x-dropdown-link href="{{ route('admin.manage.profile') }}">
                                <i class="fa-regular fa-user mr-2"></i>
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    <i class="fa-solid fa-power-off mr-2"></i>
                                    {{ __('Cerrar sesión') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</div>
