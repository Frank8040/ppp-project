<div class="relative overflow-hidden z-50 px-5 py-4 bg-white border-t bg-opacity-95 hover:bg-opacity-100 duration-300 rounded-lg shadow-xl cursor-pointer pointer-events-auto select-none border-l-4"
    x-bind:class="{
        'border-blue-500': toast.type === 'info',
        'border-green-500': toast.type === 'success',
        'border-orange-500': toast.type === 'warning',
        'border-red-500': toast.type === 'danger'
    }">
    <div class="flex items-center divide-x-2">
        <div class="w-9 h-9 pr-3 flex items-center justify-center">
            @include('vendor.tall-toasts.includes.icon')
        </div>

        <div class="flex flex-col text-sm pl-3">
            <span class="font-bold" x-html="toast.title" x-show="toast.title !== undefined"></span>
            <span class="text-gray-700 max-w-64 truncate" x-show="toast.message !== undefined" x-html="toast.message"></span>
        </div>
    </div>
</div>
