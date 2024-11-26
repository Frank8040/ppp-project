@section('header', 'Administrar')
@section('section', 'Yape')

<div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        <x-app.card>
            <div class="bg-[#700376] w-full h-max rounded-lg py-8">
                <div class="flex flex-col justify-center items-center">
                    <img class="w-12 mb-2" src="/images/yape_logo.png" alt="">

                    <div class="p-3 border border-white w-max rounded-lg relative">
                        <img class="w-36 h-36 lg:w-52 lg:h-52 object-cover rounded-lg"
                            src="{{ $yape->image ? Storage::url($yape->image->url) : '/images/default.jpg' }}"
                            alt="codigo_qr_yape">
                        <div class="absolute -bottom-3 left-0 flex justify-center w-full">
                            <span class="text-[0.625rem] py-1 px-3 bg-[#22b9a5] text-white rounded-full w-max">
                                PAGUE AQUÍ CON YAPE
                            </span>
                        </div>
                    </div>
                    <div class="mt-6 w-60 text-center">
                        <span class="text-white uppercase text-sm">
                            {{ $yape->titular }}
                        </span>
                        <p class="text-gray-300 text-xs">
                            +51 {{ $yape->telefono }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-4 gap-2">

                <x-button-gradient color="green" class="flex justify-center items-center gap-2"
                    wire:click="edit({{ $yape }})">
                    <i class="fa-solid fa-pen fa-fw"></i>
                    <span>Editar</span>
                </x-button-gradient>

                <x-button-gradient color="red" class="flex justify-center items-center gap-2"
                    wire:click="deleteItem({{ $yape->id }})">
                    <i class="fa-solid fa-trash-can fa-fw"></i>
                    <span>Eliminar</span>
                </x-button-gradient>
            </div>
        </x-app.card>

        <div class="md:col-span-2 space-y-4">
            <x-app.card>
                <img class="rounded-lg w-full h-45 object-cover"
                    src="https://tubolsillo.pe/wp-content/uploads/2023/08/como-activar-sonido-de-yape-en-mi-celular-notificacion.jpg"
                    alt="">
            </x-app.card>

            <x-app.card>
                <img class="rounded-lg w-full h-28 object-cover"
                    src="https://www.tarjetasdecredito.vip/wp-content/uploads/2022/11/Yape-del-BCP-como-funciona.webp"
                    alt="">
            </x-app.card>
        </div>

    </div>
</div>
