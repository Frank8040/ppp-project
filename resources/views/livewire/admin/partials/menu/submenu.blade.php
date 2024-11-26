<div x-show="open" x-collapse.duration.500ms x-cloak>
    @if (isset($menu))
        <ul class="pl-0.5 mt-2 lg:hidden lg:sidebar-expanded:block">
            @foreach ($menu as $submenu)
                <x-sidebar-item-link
                    href="{{ isset($submenu['url']) ? (filter_var($submenu['url'], FILTER_VALIDATE_URL) ? $submenu['url'] : route($submenu['url'])) : 'javascript:void(0)' }}"
                    :active="isset($submenu['url']) && request()->routeIs($submenu['url'])">
                    {{ isset($submenu['name']) ? $submenu['name'] : '' }}
                </x-sidebar-item-link>
            @endforeach
        </ul>
    @endif
</div>
