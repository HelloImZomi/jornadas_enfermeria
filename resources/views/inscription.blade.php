<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-center bg-cover"
         style="background-image: url(https://images.unsplash.com/photo-1519666336592-e225a99dcd2f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1888&q=80);">
        <div class="absolute bg-blue-900 opacity-80 inset-0 z-0"></div>
        <div class="max-w-md w-full h-full mx-auto z-10 bg-blue-900 rounded-3xl">
            <div class="flex flex-col">
                <div class="bg-white relative drop-shadow-2xl  rounded-3xl p-4 m-4">
                    <div class="flex-none sm:flex">
                        <div class=" relative h-32 w-32   sm:mb-0 mb-3 hidden">
                            <img
                                src="https://tailwindcomponents.com/storage/avatars/njkIbPhyZCftc4g9XbMWwVsa7aGVPajYLRXhEeoo.jpg"
                                alt="aji" class=" w-32 h-32 object-cover rounded-2xl">
                            <a href="#"
                               class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="h-4 w-4">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <div class="flex-auto justify-evenly">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center  my-1">
								<span class="mr-3 rounded-full bg-white w-8 h-8">
    <img
        src="https://image.winudf.com/v2/image1/Y29tLmJldHMuYWlyaW5kaWEudWlfaWNvbl8xNTU0NTM4MzcxXzA0Mw/icon.png?w=&amp;fakeurl=1"
        class="h-8 p-1">
</span>
                                    <h2 class="font-medium">{{ $inscription->convocation->name }}</h2>
                                </div>
                                <span
                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold
                                    leading-none text-blue-100 bg-blue-600 rounded-full"
                                >
                                    {{ $inscription->approved ? 'APROBADO' : 'EN REVISI??N' }}
                                </span>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5"></div>
                            <div class="flex items-center">
                                <div class="flex flex-col mx-auto">
                                    <img
                                        src="https://image.winudf.com/v2/image1/Y29tLmJldHMuYWlyaW5kaWEudWlfaWNvbl8xNTU0NTM4MzcxXzA0Mw/icon.png?w=&amp;fakeurl=1"
                                        class="w-20 p-1">

                                </div>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5 pt-5">
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"></div>
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"></div>
                            </div>
                            <div class="flex mb-5 p-5 text-sm">
                                <div class="flex flex-col">
                                    <span class="text-sm">Nombre</span>
                                    <div
                                        class="font-semibold"
                                    >
                                        {{ $inscription->name }}
                                    </div>
                                </div>
                                <div class="flex flex-col ml-auto">
                                    <span class="text-sm">Correo</span>
                                    <div class="font-semibold">{{ $inscription->email }}</div>
                                </div>
                            </div>
                            <div class="flex items-center mb-4 px-5">
                                <div class="flex flex-col text-sm">
                                    <span class="">Fecha</span>
                                    <div
                                        class="font-semibold">{{($inscription->convocation->start_time)->format('d/m/Y')}}</div>

                                </div>
                                <div class="flex flex-col mx-auto text-sm">
                                    <span class="">Inicio</span>
                                    <div
                                        class="font-semibold">{{($inscription->convocation->start_time)->format('g:iA')}}</div>

                                </div>
                                <div class="flex flex-col text-sm">
                                    <span class="">Cierre</span>
                                    <div
                                        class="font-semibold">{{($inscription->convocation->end_time)->format('g:iA')}}</div>

                                </div>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5 pt-5">
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"></div>
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"></div>
                            </div>
                            <div class="flex items-center px-5 pt-3 text-sm">
                                <div class="flex flex-col">
                                    <span class="">Modalidad</span>
                                    <div
                                        class="font-semibold"
                                    >
                                        {{ $inscription->modality == 1 ? 'Presencial' : 'Virtual' }}
                                    </div>
                                </div>
                                <div class="flex flex-col mx-auto">
                                    <span class="">Rol Acad??mico</span>
                                    @switch($inscription->education)
                                        @case(1)
                                        <div class="font-semibold">Estudiante</div>
                                        @break

                                        @case(2)
                                        <div class="font-semibold">Pasante</div>
                                        @break

                                        @case(3)
                                        <div class="font-semibold">Docente</div>
                                        @break

                                        @default
                                        <div class="font-semibold">Ninguno</div>
                                    @endswitch
                                </div>
                                <div class="flex flex-col">
                                    <span class="">Escuela</span>
                                    <div class="font-semibold">{{$inscription->school->name}}</div>

                                </div>
                            </div>
                            <div class="flex flex-col py-5  justify-center text-sm ">
                                <div class="mt-4 mx-auto">
                                    {{QrCode::generate($inscription->code)}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-guest-layout>
