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

<div class="min-w-fit lg:py-3 lg:pl-3" x-cloak>
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
        :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
        class=" flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-full overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-gradient-to-bl to-blue-900/95 from-sky-700/95 px-4 pb-4 transition-all duration-200 ease-in-out {{ $variant === 'v2' ? 'border-r border-gray-200 dark:border-gray-700/60' : 'rounded-lg shadow-md' }}"
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

                <div class="flex gap-4 items-center self-center text-white text-3xl">
                    <i class="fa-solid fa-dragon"></i>
                    <div class="flex flex-col lg:hidden lg:sidebar-expanded:!flex">
                        <span class="text-base font-semibold"> Bienvenido al</span>
                        <span class="text-sm -mt-1"> Panel de Control </span>
                    </div>
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
                                            class="flex items-center py-2 text-xs uppercase text-gray-300/60 dark:text-gray-500">
                                            <span class="w-1/12 h-0.5 bg-gray-300/60 dark:bg-gray-600"></span>
                                            <span
                                                class="flex-none text-xs mx-1 uppercase">{{ $menu['menuHeader'] }}</span>
                                            <span class="w-full h-0.5 bg-gray-300/60 dark:bg-gray-600"></span>
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
                            <li class="px-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-gradient-to-l from-white/10 to-white/10 @if (in_array(request()->route()->getName(), $first_url) ||
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

        <!-- Expand / collapse button -->
        <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto relative">
            <div class="w-12 pl-4 pr-3 py-2">
                <button
                    class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="shrink-0 fill-current text-gray-400 dark:text-gray-500 sidebar-expanded:rotate-180"
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>
