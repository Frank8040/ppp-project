<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.svg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="/css/styles.css">
    <!-- Styles -->
    @livewireStyles

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }
    </script>

    @wireUiScripts

</head>

<body class="font-inter antialiased bg-gray-200 dark:bg-gray-900 text-gray-600 dark:text-gray-400"
    :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <livewire:toasts />

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <div>

        @php
            $route = Route::getRoutes()->getByAction(request()->route()->getActionName());
        @endphp

        @if (Auth::user() && $route && in_array('auth:sanctum', $route->gatherMiddleware()))
            <div class="flex h-[100dvh] overflow-hidden relative">

                <div class="bg-gradient-to-bl to-blue-900 from-sky-600 w-[90%] absolute top-0 right-0 py-36 rounded-bl-full"></div>

                <div class="bg-gradient-to-bl to-blue-900 from-sky-600 absolute bottom-0 p-16 rounded-tr-full"></div>
                <div class="bg-gradient-to-bl to-blue-900 from-sky-600 absolute bottom-0 right-0 p-24 rounded-tl-full"></div>

                <x-app.sidebar :variant="$attributes['sidebarVariant']" />

                <!-- Content area -->
                <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
                    x-ref="contentarea">

                    <x-app.header :variant="$attributes['headerVariant']" />

                    <main class="grow px-3 pb-2">

                        <div class="text-xs sm:text-sm text-gray-100 mb-4 bg-gradient-to-bl to-blue-900 from-sky-600 rounded-md px-4 py-2">
                            <a href="{{ route('admin.home') }}" class="text-gray-100 hover:text-gray-200">
                                <i class="fa-solid fa-house-chimney"></i> /
                            </a>
                            <span class="text-gray-300">@yield('header')</span>
                            / <span class="font-semibold">@yield('section')</span>
                        </div>

                        {{ $slot }}
                    </main>

                    <div class="">
                        @include('livewire.admin.partials.footer')
                    </div>

                </div>

            </div>
        @else
            <main>
                {{ $slot }}
            </main>
        @endif
    </div>

    @stack('modals')

    @livewireScripts

</body>

</html>
