@section('header', __('Tabla'))
@section('section', __('Categorias'))

<div>

    {{-- @include('livewire.admin.modal.user')

    @include('livewire.admin.modal.delete') --}}

    <x-app.card>
        <div class="relative flex flex-col w-full h-full text-gray-700 dark:text-gray-400">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center mb-3">
                <div class="w-full md:w-72">
                    <x-input-label wire:model.live="search" search label="Buscar" />
                </div>
                @can('admin.categories.create')
                    <x-button-gradient class="flex items-center gap-2" wire:click="create()">
                        <i class="fa-solid fa-plus"></i>
                        <span class="hidden sm:block">Nuevo</span>
                    </x-button-gradient>
                @endcan
            </div>
            <x-table-container>
                <div wire:loading wire:target="search" class="absolute w-full h-full z-10 pt-10">
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
                            <th class="p-3 font-normal text-center">Categoria</th>
                            <th class="p-3 font-normal">Slug</th>
                            <th class="p-3 font-normal">Estado</th>
                            <th class="p-3 font-normal">Actualizado</th>
                            <th class="p-3 font-normal">Usuario</th>
                            <th class="p-3 font-normal text-center">Acciones</th>
                        </tr>
                    </x-table-thead>
                    <tbody class="text-sm divide-y divide-gray-300">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-3">
                                    <div class="flex gap-3">
                                        <div class="relative">
                                            <img class="w-10 h-10 border-2 rounded-full object-cover"
                                                src="{{ $category->image ? Storage::url($category->image->url) : '/images/default.jpg' }}"
                                                alt="{{ $category->name }}">
                                            <span
                                                class="absolute bottom-0 right-0 p-1 border-white border-2 bg-{{ $category->status === 1 ? 'green' : 'red' }}-600 rounded-full"></span>
                                        </div>
                                        <div>
                                            <div class="font-semibold">{{ $category->name }}</div>
                                            <div class="text-gray-600 dark:text-gray-500">0 productos relacionados</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <x-tag class="w-max" role="7"
                                        style="text-transform: none">{{ $category->name }}</x-tag>
                                </td>
                                <td class="p-3">
                                    <x-switch option="{{ $category->status }}" left="Inactivo" right="Activo"
                                        wire:click="changeStatus({{ $category->id }})" />
                                </td>
                                <td class="p-3">
                                    <div>
                                        <i class="fa-regular fa-calendar fa-fw"></i>
                                        {{ \Carbon\Carbon::parse($category->updated_at)->format('d-m-Y') }}
                                    </div>
                                    <div>
                                        <i class="fa-regular fa-clock fa-fw"></i>
                                        {{ \Carbon\Carbon::parse($category->updated_at)->format('H:i:s') }}
                                    </div>
                                </td>
                                <td class="p-3">
                                    <x-tag class="w-max" role="2" style="text-transform: none">
                                        {{ $category->user->name }} {{ $category->user->surnames }}
                                    </x-tag>
                                </td>
                                <td class="p-3 w-10">
                                    <div class="flex justify-center relative">
                                        @can('admin.categories.show')
                                            <x-button-tooltip hover="blue" content="Visualizar"
                                                wire:click="showUserDetail({{ $category }})">
                                                <i class="fa-solid fa-eye fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                        @can('admin.categories.edit')
                                            <x-button-tooltip hover="green" content="Editar"
                                                wire:click="edit({{ $category }})">
                                                <i class="fa-solid fa-pen fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                        @can('admin.categories.delete')
                                            <x-button-tooltip hover="red" content="Eliminar"
                                                wire:click="deleteItem({{ $category->id }})">
                                                <i class="fa-solid fa-trash-can fa-fw"></i>
                                            </x-button-tooltip>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (!$categories->count())
                            <tr>
                                <td colspan="7" class="p-3 text-center text-sm">
                                    No existe ningún registro coincidente con la búsqueda.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </x-table-container>
            @if ($categories->count())
                {{ $categories->links() }}
            @endif
        </div>
    </x-app.card>
</div>
