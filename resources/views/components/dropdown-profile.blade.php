@props([
    'align' => 'right',
])

<div class="relative inline-flex" x-data="{ open: false }">
    <button class="inline-flex justify-center items-center group" aria-haspopup="true" @click.prevent="open = !open"
        :aria-expanded="open">
        <img class="w-8 h-8 rounded-full"
            src="{{ Auth::user()->profile_photo_path ? Storage::url(Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}"
            width="32" height="32" alt="{{ Auth::user()->name }}" />
        <div class="flex items-center truncate">
            <span
                class="truncate ml-2 hidden lg:block text-sm font-medium text-gray-600 dark:text-gray-100 group-hover:text-gray-800 dark:group-hover:text-white">{{ Auth::user()->name }}</span>
            <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500" viewBox="0 0 12 12">
                <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
            </svg>
        </div>
    </button>
    <div class="origin-top-right z-10 absolute top-full min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700/60 rounded-lg shadow-lg overflow-hidden mt-1 {{ $align === 'right' ? 'right-0' : 'left-0' }}"
        @click.outside="open = false" @keydown.escape.window="open = false" x-show="open"
        x-transition:enter="transition ease-out duration-200 transform"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak>
        <div class="px-4 py-2 bg-gray-100">
            <div class="font-medium text-sm text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">
                {{ Auth::user()->name }} {{ Auth::user()->surnames }}</div>
            <div class="font-medium text-xs text-gray-500 whitespace-nowrap overflow-hidden text-ellipsis">
                {{ Auth::user()->email }}</div>
        </div>

        <div class="w-full px-2 mt-2">
            <x-tag class="bg-gradient-to-tr from-orange-600 to-yellow-500 font-normal text-white text-[0.620rem] block text-center rounded">
                {{ Auth::user()->roles->first()->name ?? 'Undefined' }}
            </x-tag>
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
    </div>
</div>
