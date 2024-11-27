@section('header', __('Tabla'))
@section('section', __('Registrar PPP'))

<div>

    {{-- @include('livewire.admin.modal.user') --}}

    {{-- @include('livewire.admin.modal.assign-role-user') --}}

    @include('livewire.admin.modal.delete')

    <x-app.card>
        <div class="relative flex flex-col w-full h-full text-gray-700 dark:text-gray-400">
            <!-- Mostrar formulario de "Nuevo Registro" si $isCreating es verdadero -->
            @if ($isCreating)
                <div class="relative grid w-full h-full text-gray-700 dark:text-gray-400">
                    @if ($currentStep == 1)
                        <div class="grid justify-center gap-4 md:flex-row md:items-center mb-3 text-center">
                            <div style="background-color: #353333; margin-bottom: 15px;" class="pb-5">
                                <h3 class="text-center text-white p-3">Ingrese el Código del Estudiante</h3>
                            </div>
                            <div class="w-full grid justify-center md:w-72">
                                <x-input-label wire:model="codigoEstudiante" label="Código"
                                    wire:model.live="codigoEstudiante" type="text" />
                                <x-button wire:click="buscarEstudiante" class="bg-slate-600 mt-2">Buscar</x-button>
                            </div>
                        </div>
                    @endif

                    <!-- Paso 2: Mostrar solo cuando el paso actual es 2 -->
                    @if ($currentStep == 2)
                        <div class="flex justify-center gap-5">
                            <div class="w-full">
                                <div style="background-color: #353333; margin-bottom: 15px;" class="pb-5">
                                    <h3 class="text-center text-white p-3">Datos del Estudiante</h3>
                                </div>
                                <div class="col-span-2 flex flex-col gap-3">
                                    <x-input-label label="Código" wire:model="studentData.code" />
                                    <x-input-label label="Nombres y Apellidos" wire:model="studentData.names" />
                                    <x-input-label label="DNI" wire:model="studentData.dni" />
                                </div>
                            </div>
                            <div class="w-full">
                                <div style="background-color: #353333; margin-bottom: 15px;" class="pb-5">
                                    <h3 class="text-center text-white p-3">Datos de la Empresa</h3>
                                </div>
                                <div class="col-span-2 flex flex-col gap-3">
                                    <x-input-label label="Razón Social" wire:model.live="companyData.razon_social"
                                        type="text" />
                                    <x-input-label label="RUC" wire:model.live="companyData.ruc" type="text" />
                                    <x-input-label label="Dirección Fiscal" wire:model.live="companyData.direccion"
                                        type="text" />
                                    <x-input-label label="Responsable" wire:model.live="companyData.responsable"
                                        type="text" />
                                </div>
                            </div>
                            {{-- <x-button wire:click="nextStep" class="bg-slate-600 mt-2">Siguiente</x-button> --}}
                        </div>
                    @endif

                    <!-- Paso 3: Mostrar solo cuando el paso actual es 3 -->
                    @if ($currentStep == 3)
                        <div class="w-full">
                            <div style="background-color: #353333; margin-bottom: 15px;" class="pb-5">
                                <h3 class="text-center text-white p-3">Documentos</h3>
                            </div>
                            <div class="flex flex-col gap-5">
                                <div class="flex justify-center items-start" style="gap: 2rem;">
                                    <!-- Lado izquierdo: Nombre del PDF -->
                                    <div class="w-1/3">
                                        <h3 class="text-lg font-bold">Archivo</h3>
                                        <div>
                                            <a href="{{ asset('pdf/Prueba.pdf') }}" 
                                               target="_blank" 
                                               class="block bg-gray-100 text-blue-500 rounded-lg px-4 py-2 hover:bg-slate-200 transition duration-200">
                                                CartadeAceptacion.pdf
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Lado derecho: Previsualización del PDF -->
                                    <div class="w-2/3 relative">
                                        <h3 class="text-lg font-bold mb-3">Previsualización</h3>
                                        <!-- Ícono de descarga sobre el iframe -->
                                        <a href="{{ asset('pdf/Prueba.pdf') }}" download
                                            class="absolute top-2 right-2 bg-blue-500 text-white rounded-full p-2 hover:bg-blue-600 z-10"
                                            title="Descargar PDF">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <iframe src="{{ asset('pdf/Prueba.pdf') }}" width="100%" height="400px"
                                            class="border border-gray-300 rounded">
                                        </iframe>
                                    </div>
                                </div>

                            </div>

                            <!-- Botones -->
                            <div class="flex justify-center mt-5">
                                <x-button wire:click="guardarSolicitud()" class="bg-slate-600 mt-2">Guardar
                                    Solicitud</x-button>
                                {{-- <x-button wire:click="previousStep" class="bg-slate-600 mt-2">Anterior</x-button> --}}
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-between mt-4">
                        @if ($currentStep > 1)
                            <x-button wire:click="previousStep" class="bg-slate-600 mt-2">Anterior</x-button>
                        @endif

                        @if ($currentStep = 1)
                            <div class="flex justify-end mt-4">
                                <x-button-gradient wire:click="cancelCreate">
                                    <span>Cancelar</span>
                                </x-button-gradient>
                            </div>
                        @endif

                        @if ($currentStep < 2)
                            <x-button wire:click="nextStep" class="bg-slate-600 mt-2">Siguiente</x-button>
                        @endif
                    </div>
                </div>
            @else
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center mb-3">
                    <div class="w-full md:w-72">
                        <x-input-label wire:model.live="search" search label="Buscar" />
                    </div>

                    <div class="flex gap-2 justify-center">
                        @can('admin.register-ppp')
                            <x-button-gradient class="flex items-center gap-2" wire:click="create()">
                                <i class="fa-solid fa-plus"></i>
                                <span class="hidden sm:block">Nuevo Registro</span>
                            </x-button-gradient>
                        @endcan
                    </div>
                </div>
                <!-- Mostrar tabla de solicitudes si no estamos creando un nuevo registro -->
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
                                <th class="p-3 font-normal text-center">Código</th>
                                <th class="p-3 font-normal text-center">Nombre</th>
                                <th class="p-3 font-normal">Descripción</th>
                                <th class="p-3 font-normal">Línea</th>
                                <th class="p-3 font-normal">Estado</th>
                                <th class="p-3 font-normal">Actualizado</th>
                                <th class="p-3 font-normal text-center">Acciones</th>
                            </tr>
                        </x-table-thead>
                        <tbody class="text-sm divide-y divide-gray-300">
                            @foreach ($solicitudes as $solicitud)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-3">{{ $solicitud->user->code }}</td>
                                    <td class="p-3">{{ $solicitud->user->name }}</td>
                                    <td class="p-3">{{ $solicitud->paso }}</td>
                                    <td class="p-3">{{ $solicitud->linea }}</td>
                                    <td class="p-3">
                                        <div
                                            class="text-xs font-bold text-{{ $solicitud->estado === 1 ? 'green' : 'red' }}-500 uppercase">
                                            <i class="fa-regular fa-square-check fa-lg mr-1"></i>
                                            {{ $solicitud->estado === 1 ? 'Registrado' : 'No Registrado' }}
                                        </div>
                                    </td>
                                    <td class="p-3">
                                        <div>
                                            <i class="fa-regular fa-calendar fa-fw"></i>
                                            {{ \Carbon\Carbon::parse($solicitud->updated_at)->format('d-m-Y') }}
                                        </div>
                                        <div>
                                            <i class="fa-regular fa-clock fa-fw"></i>
                                            {{ \Carbon\Carbon::parse($solicitud->updated_at)->format('H:i:s') }}
                                        </div>
                                    </td>
                                    <td class="p-3 w-10">
                                        <div class="flex justify-center relative">
                                            @can('admin.register-ppp')
                                                <x-button-tooltip hover="green" content="Editar"
                                                    wire:click="edit({{ $solicitud }})">
                                                    <i class="fa-solid fa-pen fa-fw"></i>
                                                </x-button-tooltip>
                                            @endcan
                                            @can('admin.register-ppp')
                                                <x-button-tooltip hover="red" content="Eliminar"
                                                    wire:click="deleteItem({{ $solicitud->id }})">
                                                    <i class="fa-solid fa-trash-can fa-fw"></i>
                                                </x-button-tooltip>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (!$solicitudes->count())
                                <tr>
                                    <td colspan="7" class="p-3 text-center text-sm">
                                        No existe ningún registro coincidente con la búsqueda.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </x-table-container>
            @endif

            @if ($solicitudes->count())
                {{ $solicitudes->links() }}
            @endif
        </div>
    </x-app.card>

</div>

@section('script')
    <script type="module">
        window.Echo.channel("registrarPPP").
        listen(".guardarSolicitud", (e) => {
            @this.call('refreshRegistrarPPP');
        });
    </script>
@endsection
