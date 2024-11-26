<div>
    <x-dialog-modal wire:model="isOpenAssign" maxWidth="lg">
        <x-slot name="title">
            <i class="fa-solid fa-unlock-keyhole mr-2"></i>
            {{ $isOpenAssign && $role->permissions()->count() > 0 ? 'Actualizar permisos del rol' : 'Asignar permisos al rol' }}
        </x-slot>
        <x-slot name="content">
            <form autocomplete="off">
                <div class="w-full px-2">
                    <div class="flex justify-between items-center">
                        <x-app.label value="LISTA DE PERMISOS:" class="font-bold mb-1" />

                        <x-tag
                            class="bg-gradient-to-tr from-orange-600 to-yellow-500 font-normal text-white text-[0.620rem] block text-center rounded-md">
                            {{ $role ? $role->name : '' }}
                        </x-tag>
                    </div>
                    <hr class="my-2">
                    <div class="grid grid-cols-1 sm:grid-cols-2">
                        @foreach ($permissions as $section => $permissionsInSection)
                            <div class="mb-1.5">
                                <h3 class="text-sm font-semibold text-gray-900 mb-1">{{ $section }}</h3>
                                @foreach ($permissionsInSection as $permission)
                                    <div class="flex w-full items-center mb-1">
                                        <label htmlFor="checkbox"
                                            class="relative flex items-center gap-2 pr-2 rounded-full cursor-pointer">
                                            <input wire:model.live="listPermissions" type="checkbox"
                                                value="{{ $permission->id }}"
                                                class="before:content[''] peer relative h-4 w-4 cursor-pointer appearance-none rounded border border-gray-400 hover:border-blue-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-9 before:w-9 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity focus:ring-0 hover:checked:bg-gray-900 focus:checked:bg-gray-900 checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                            <span class="text-sm font-medium text-gray-900 peer-hover:text-blue-900">
                                                {{ $permission->description }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <button data-ripple-dark="true" x-on:click="show = false" wire:click="closeModals"
                class="px-4 py-2.5 mr-1 font-sans text-xs font-bold text-red-500 uppercase transition-all rounded-lg middle none center hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                Cancelar
            </button>

            <x-button-gradient color="green" wire:click="updateRolePermissions({{ $role }})"
                wire:loading.attr="disabled" wire:target="updateRolePermissions">
                <span wire:loading wire:target="updateRolePermissions" class="mr-2">
                    <i class="fa fa-spinner fa-spin"></i>
                </span>
                {{ $isOpenAssign && $role->permissions()->count() > 0 ? 'Actualizar' : 'Asignar' }}
            </x-button-gradient>
        </x-slot>

    </x-dialog-modal>
</div>
