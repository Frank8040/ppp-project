@section('header', __('Tabla'))
@section('section', __('Usuarios'))

<div>

    @include('livewire.admin.modal.user')

    @include('livewire.admin.modal.assign-role-user')

    @include('livewire.admin.modal.delete')

    <x-app.card>
        <div class="relative flex flex-col w-full h-full text-gray-700 dark:text-gray-400">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center mb-3">
                <div class="w-full md:w-72">
                    <x-input-label wire:model.live="search" search label="Buscar" />
                </div>

                <div class="flex gap-2 justify-center">

                    <x-select-menu label="Estado" selected="{{ $userState === '' ? 'Todos' : '' }}" class="min-w-40"
                        value="{{ isset($userState) ? ($userState === 1 ? 'Activo' : 'Inactivo') : 'Todos' }}">
                        <x-slot name="options">
                            <x-select-option wire:click="$set('userState', null)" value="Todos">
                                {{ __('Todos') }}
                            </x-select-option>
                            <x-select-option wire:click="$set('userState', 1)" value='1'>
                                Activo
                            </x-select-option>
                            <x-select-option wire:click="$set('userState', 0)" value='0'>
                                Inactivo
                            </x-select-option>
                        </x-slot>
                    </x-select-menu>
                    <x-select-menu label="Rol" selected="{{ $userRol === '' ? 'Todos' : '' }}" class="min-w-40"
                        value="{{ isset($userRol) ? $roles->firstWhere('id', $userRol)->name : 'Todos' }}">
                        <x-slot name="options">
                            <x-select-option wire:click="$set('userRol', null)" value="Todos">
                                {{ __('Todos') }}
                            </x-select-option>
                            @foreach ($roles as $rol)
                                <x-select-option wire:click="$set('userRol', '{{ $rol->id }}')"
                                    value='{{ $rol->id }}'
                                    isSelected="{{ $userRol === $rol->id ? $userRol : '' }}">
                                    {{ $rol->name }}
                                </x-select-option>
                            @endforeach
                        </x-slot>
                    </x-select-menu>
                    @can('admin.users.create')
                        <x-button-gradient class="flex items-center gap-2" wire:click="create()">
                            <i class="fa-solid fa-plus"></i>
                            <span class="hidden sm:block">Nuevo</span>
                        </x-button-gradient>
                    @endcan
                </div>

            </div>
            <x-table-container>
                <div wire:loading wire:target="userState, userRol, search" class="absolute w-full h-full z-10 pt-10">
                    <div class="relative h-full w-full">
                        <div class="absolute inset-0 bg-white bg-opacity-50 backdrop-blur-[2px]"></div>
                        <div class="absolute inset-0 flex justify-center items-center bg-opacity-0">
                            <div>
                                <i class="fa fa-spinner fa-spin"></i> Cargando...
                            </div>
                        </div>
                    </div>
                </div>
                <table class="w-full text-left table-auto min-w-max">
                    <x-table-thead>
                        <tr>
                            <th class="p-3 font-normal text-center">Usuario</th>
                            <th class="p-3 font-normal">Email</th>
                            <th class="p-3 font-normal">Teléfono</th>
                            <th class="p-3 font-normal">Área</th>
                            <th class="p-3 font-normal">Actualizado</th>
                            <th class="p-3 font-normal text-center">Acciones</th>
                        </tr>
                    </x-table-thead>
                    <tbody class="text-sm divide-y divide-gray-300">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-3">
                                    <div class="flex gap-3">
                                        <div class="font-semibold">{{ $user->name }} {{ $user->surnames }}</div>
                                    </div>
                                </td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3">{{ $user->phone }}</td>
                                <td class="p-3">
                                    <div
                                        class="text-xs font-bold text-{{ $user->area != null ? 'green' : 'red' }}-500 uppercase">
                                        {{ $user->area != null ? $user->area : 'No asignado' }}
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div>
                                        <i class="fa-regular fa-calendar fa-fw"></i>
                                        {{ \Carbon\Carbon::parse($user->updated_at)->format('d-m-Y') }}
                                    </div>
                                    <div>
                                        <i class="fa-regular fa-clock fa-fw"></i>
                                        {{ \Carbon\Carbon::parse($user->updated_at)->format('H:i:s') }}
                                    </div>
                                </td>
                                <td class="p-3 w-10">
                                    <div class="flex justify-center relative">
                                        @can('admin.users.assign-role')
                                            <x-button-tooltip hover="gray"
                                                content="{{ $user->roles()->count() > 0 ? 'Editar Rol' : 'Asignar Rol' }}"
                                                wire:click="showRoles({{ $user }})">
                                                <i class="fa-solid fa-user-lock fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                        @can('admin.users.show')
                                            <x-button-tooltip hover="blue" content="Visualizar"
                                                wire:click="showUserDetail({{ $user }})">
                                                <i class="fa-solid fa-eye fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                        @can('admin.users.edit')
                                            <x-button-tooltip hover="green" content="Editar"
                                                wire:click="edit({{ $user }})">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                        @can('admin.users.delete')
                                            <x-button-tooltip hover="red" content="Eliminar"
                                                wire:click="deleteItem({{ $user->id }})">
                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$users->count())
                            <tr>
                                <td colspan="7" class="p-3 text-center text-sm">
                                    No existe ningún registro coincidente con la búsqueda.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </x-table-container>
            @if ($users->count())
                {{ $users->links() }}
            @endif
        </div>
    </x-app.card>
</div>

@section('script')
    <script type="module">
        window.Echo.channel("users").
        listen(".create", (e) => {
            @this.call('refreshUsers');
        });
    </script>
@endsection
