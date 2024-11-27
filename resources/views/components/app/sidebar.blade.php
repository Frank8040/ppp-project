@php
    $menuData = json_decode(file_get_contents(resource_path('menu/verticalMenu.json')), true);
    $user = Auth::user();

    $userMenus = [];

    if ($user && $user->roles->isNotEmpty()) {
        $userPermissions = $user->roles
            ->flatMap(function ($role) {
                return $role->permissions->pluck('name');
            })
            ->unique()
            ->toArray();

        $userMenus = collect($menuData['menu'])
            ->filter(function ($menu) use ($userPermissions) {
                return isset($menu['permissions']) && !empty(array_intersect($menu['permissions'], $userPermissions));
            })
            ->map(function ($menu) use ($userPermissions) {
                if (isset($menu['submenu'])) {
                    $menu['submenu'] = array_filter($menu['submenu'], function ($submenu) use ($userPermissions) {
                        return isset($submenu['permissions']) &&
                            !empty(array_intersect($submenu['permissions'], $userPermissions));
                    });
                }
                return $menu;
            })
            ->toArray();
    }
@endphp

<div class="min-w-fit" x-cloak>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class=" flex lg:!flex flex-col absolute z-40 left-0 top-0 border lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-full overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-white px-4 pb-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200 dark:border-gray-700/60' : 'shadow-md' }}"
        :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-64'" @click.outside="sidebarOpen = false"
        @keydown.escape.window="sidebarOpen = false" x-cloak>

        <!-- Sidebar header -->
        <div class="flex justify-center py-4 sticky top-0 z-10">
            <!-- Close button -->
            <button class="lg:hidden text-gray-500 hover:text-gray-400 absolute top-4 left-0 lg:top-4 lg:left-4"
                @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <!-- Logo -->
            <a class="block" href="{{ route('admin.home') }}">

                <div class="flex items-center self-center px-4 lg:px-0 lg:sidebar-expanded:px-4 2xl:px-4">
                    <img class="w-full lg:hidden lg:sidebar-expanded:block 2xl:block" src="/images/logo_upeu.svg" alt="">
                    <img class="w-full hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden" src="/images/logo_upeu_2.webp" alt="">
                </div>
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8 relative">
            <!-- Pages group -->
            <div>
                <ul class="">

                    @foreach ($userMenus as $menu)
                        @if (isset($menu['menuHeader']))
                            @php
                                $showMenuHeader = count(array_intersect($menu['permissions'], $userPermissions)) > 0;
                            @endphp
                            @if ($showMenuHeader)
                                <div class="text-xs uppercase text-gray-400 dark:text-gray-500 font-semibold">
                                    <div class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center"
                                        aria-hidden="true">•••</div>
                                    <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                                        <li
                                            class="flex items-center py-2 text-xs uppercase text-gray-400/60 dark:text-gray-500">
                                            <span class="w-1/12 h-0.5 bg-gray-400/60 dark:bg-gray-600"></span>
                                            <span
                                                class="flex-none text-xs mx-1 uppercase">{{ $menu['menuHeader'] }}</span>
                                            <span class="w-full h-0.5 bg-gray-400/60 dark:bg-gray-600"></span>
                                        </li>
                                    </div>
                                </div>
                            @endif
                        @else
                            @php
                                $first_url = [];
                                $urls = [];

                                if (isset($menu['submenu'])) {
                                    foreach ($menu['submenu'] as $segundoSubmenu) {
                                        $first_url[] = $segundoSubmenu['url'];
                                        if (isset($segundoSubmenu['submenu'])) {
                                            foreach ($segundoSubmenu['submenu'] as $sub_submenu_item) {
                                                if (isset($sub_submenu_item['url'])) {
                                                    $urls[] = $sub_submenu_item['url'];
                                                }
                                            }
                                        }
                                    }
                                }
                            @endphp
                            <li class="rounded-lg mb-0.5 last:mb-0 bg-gradient-to-l from-white/10 to-white/10 @if (in_array(request()->route()->getName(), $first_url) ||
                                    in_array(request()->route()->getName(), $urls) ||
                                    (isset($menu['url']) && request()->routeIs($menu['url']))) {{ '!from-white/80 !to-white/95' }} @endif"
                                x-data="{ open: {{ in_array(request()->route()->getName(), $first_url) || in_array(request()->route()->getName(), $urls) ? 'true' : 'false' }} }">
                                @if (isset($menu['submenu']))
                                    <x-sidebar-menu @click="open = ! open; sidebarExpanded = true" :active="in_array(request()->route()->getName(), $first_url) ||
                                        in_array(request()->route()->getName(), $urls)"
                                        icon="{{ isset($menu['icon']) ? $menu['icon'] : '' }}">
                                        {{ isset($menu['name']) ? $menu['name'] : 'Undefined' }}
                                    </x-sidebar-menu>
                                @else
                                    <x-sidebar-link
                                        href="{{ isset($menu['url']) ? (filter_var($menu['url'], FILTER_VALIDATE_URL) ? $menu['url'] : route($menu['url'])) : 'javascript:void(0)' }}"
                                        :active="isset($menu['url']) && request()->routeIs($menu['url'])" icon="{{ isset($menu['icon']) ? $menu['icon'] : '' }}">
                                        {{ isset($menu['name']) ? $menu['name'] : '' }}
                                    </x-sidebar-link>
                                @endif

                                @isset($menu['submenu'])
                                    @include('livewire.admin.partials.menu.submenu', [
                                        'menu' => $menu['submenu'],
                                    ])
                                @endisset
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>
