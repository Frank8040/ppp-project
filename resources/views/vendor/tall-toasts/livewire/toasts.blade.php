<div
    x-data='ToastComponent($wire)'
    @mouseleave="scheduleRemovalWithOlder()"
    class="fixed top-0 z-50 px-4 py-3 max-w-sm pointer-events-none right-0 toasts-container"
>
    <template
        x-for="toast in toasts.filter((a)=>a)"
        :key="toast.index"
    >
        <div
            @mouseenter="cancelRemovalWithNewer(toast.index)"
            @mouseleave="scheduleRemovalWithOlder(toast.index)"
            @click="remove(toast.index)"
            class="mb-2"
            x-show="toast.show===1"
            x-transition:enter="ease-out duration-500 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-10"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-init="$nextTick(()=>{toast.show=1})"
        >
            @include('vendor.tall-toasts.includes.content')
        </div>
    </template>
</div>
