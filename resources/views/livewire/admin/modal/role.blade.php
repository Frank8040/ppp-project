<div>
    <x-dialog-modal wire:model="isOpen" maxWidth="md">
        <x-slot name="title">
            <i class="fa-solid fa-unlock-keyhole  mr-2"></i>
            {{ $roleId ? 'Actualizar rol' : 'Registrar nuevo rol' }}
        </x-slot>
        <x-slot name="content">
            <div
                class="relative flex items-center w-full px-4 py-4 text-blue-100 bg-gradient-to-tr from-blue-900 to-blue-800 rounded-lg font-regular mb-4">
                <i class="fa-solid fa-circle-exclamation fa-lg"></i>
                <div class="ml-3 mr-12 text-sm">
                    Crea o edita el rol para luego asignarle permisos
                </div>
            </div>
            <form autocomplete="off" wire:keydown.enter.prevent="store()">
                <x-input-label for="name" label="Nombre del rol" wire:model.live="name" type="text" required />
            </form>
        </x-slot>
        <x-slot name="footer">
            <button data-ripple-dark="true" wire:click="$set('isOpen',false)"
                class="px-4 py-2.5 mr-1 font-sans text-xs font-bold text-red-500 uppercase transition-all rounded-lg middle none center hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                Cancelar
            </button>

            <x-button-gradient color="green" wire:click.prevent="store()" wire:loading.attr="disabled"
                wire:target="store">
                <span wire:loading wire:target="store" class="mr-2">
                    <i class="fa fa-spinner fa-spin"></i>
                </span>
                {{ $roleId ? 'Actualizar' : 'Registrar' }}
            </x-button-gradient>
        </x-slot>

    </x-dialog-modal>
</div>
