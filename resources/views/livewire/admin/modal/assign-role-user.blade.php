<div>
    <x-dialog-modal wire:model="isOpenAssign" maxWidth="sm">
        <x-slot name="title">
            <i class="fa-solid fa-user-lock mr-2"></i>
            {{ $isOpenAssign && $user->roles()->count() > 0 ? 'Actualizar roles del usuario' : 'Asignar roles al usuario' }}
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">
                <div class="mb-3 text-center">
                    <span class="bg-gradient-to-r from-orange-600 to-yellow-500 text-white text-sm px-4 py-1 rounded-md">
                        {{ $user ? $user->name .' '. $user->surnames : '' }}
                    </span>
                </div>
                <div class="flex justify-center items-center gap-3">
                    <div class="w-36 h-36">
                        <img class="w-full h-full mx-auto border-2 rounded-xl object-cover"
                            src="{{ $user ? ($user->profile_photo_path ? Storage::url($user->profile_photo_path) : $user->profile_photo_url) : '' }}"
                            alt="{{ $user ? $user->name : '' }}">
                    </div>
                    <div>
                        <div class="w-full px-2">
                            <x-label value="LISTA DE ROLES:" class="font-bold mb-1" />
                            @foreach ($roles as $role)
                                <div class="flex w-full items-center mb-1">
                                    <label htmlFor="checkbox"
                                        class="relative flex items-center pr-2 rounded-full cursor-pointer">
                                        <input wire:model.live="listRoles" type="checkbox" value="{{ $role->id }}"
                                            class="before:content[''] peer relative h-4 w-4 cursor-pointer appearance-none rounded border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-9 before:w-9 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity focus:ring-0 hover:checked:bg-gray-900 focus:checked:bg-gray-900 checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    </label>
                                    <label class="text-sm font-medium text-gray-900">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button data-ripple-dark="true" x-on:click="show = false" wire:click="closeModals"
                class="px-4 py-2.5 mr-1 font-sans text-xs font-bold text-red-500 uppercase transition-all rounded-lg middle none center hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                Cancelar
            </button>

            <x-button-gradient color="green" wire:click.prevent="updateRoleUser({{ $user }})"
                wire:loading.attr="disabled" wire:target="updateRoleUser">
                <span wire:loading wire:target="updateRoleUser" class="mr-2">
                    <i class="fa fa-spinner fa-spin"></i>
                </span>
                {{ $isOpenAssign && $user->roles()->count() > 0 ? 'Actualizar' : 'Asignar' }}
            </x-button-gradient>
        </x-slot>

    </x-dialog-modal>
</div>
