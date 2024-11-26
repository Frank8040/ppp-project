@section('header', __('Seguridad'))
@section('section', __('Roles'))

<div>

    @include('livewire.admin.modal.assign-permission-role')
    @include('livewire.admin.modal.role')

    <div class="flex flex-col gap-4">
        <x-app.card>
            <div class="relative w-full h-full text-gray-700 dark:text-gray-400">
                <div class="flex flex-col justify-between gap-4 sm:flex-row items-center">
                    <div class="text-center sm:text-left">
                        <h5 class="block text-lg font-semibold">
                            Lista de roles
                        </h5>
                        <p class="block text-sm">
                            Ver información sobre todos los roles
                        </p>
                    </div>
                    @can('admin.roles.create')
                        <x-button-gradient class="flex items-center gap-2" wire:click="create()">
                            <i class="fa-solid fa-plus"></i>
                            <span class="">Nuevo</span>
                        </x-button-gradient>
                    @endcan
                </div>
            </div>
        </x-app.card>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-4">
            @foreach ($roles as $index => $role)
                <x-app.card class="hover:scale-[1.04] duration-300">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $role->name }}</h2>
                            <div class="text-xs font-semibold text-gray-500 dark:text-gray-500 uppercase mb-3">
                                este rol tiene
                            </div>
                            <div class="flex">
                                <div class="text-3xl font-bold text-gray-800 dark:text-gray-100 mr-2">
                                    {{ $role->permissions()->count() }}
                                </div>
                                <span class="text-xs">
                                    permisos <br> en total
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between items-end">
                            <div
                                class="text-white px-5 py-4 bg-gradient-to-bl to-gray-700 from-gray-500 rounded-lg h-max">
                                <i class="fa-solid fa-user-secret fa-xl fa-fw"></i>
                            </div>
                            <div class="flex justify-center">
                                @can('admin.roles.assign-permission')
                                    <x-button-tooltip hover="gray"
                                        content="{{ $role->permissions()->count() > 0 ? 'Editar permisos' : 'Asignar permisos' }}"
                                        wire:click="showPermissions({{ $role }})">
                                        <i class="fa-solid fa-unlock-keyhole fa-fw"></i>
                                    </x-button-tooltip>
                                @endcan
                                @can('admin.roles.edit')
                                    <x-button-tooltip hover="green" content="Editar"
                                        wire:click="edit({{ $role }})">
                                        <i class="fa-solid fa-pen fa-fw"></i>
                                    </x-button-tooltip>
                                @endcan
                            </div>
                        </div>
                    </div>
                </x-app.card>
            @endforeach

        </div>
    </div>

</div>
