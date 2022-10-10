<section class="bg-white dark:bg-gray-900">
    <div class="flex justify-center min-h-screen">
        <div class="hidden bg-cover lg:block lg:w-2/5"
             style="background-image: url('https://images.unsplash.com/photo-1494621930069-4fd4b2e24a11?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=715&amp;q=80')">
        </div>
        <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
            <div class="w-full">
                <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                    Inscribete ahora.
                </h1>

                <form
                    wire:submit.prevent="save"
                    class="grid grid-cols-1 gap-6 mt-8"
                >
                    <div>
                        <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Nombre
                            completo</label>
                        <input
                            wire:model="inscription.name"
                            type="text"
                            placeholder="Ingresa tu nombre completo"
                            required
                            class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border
                                border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300
                                dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400
                                focus:outline-none focus:ring focus:ring-opacity-40"
                        >
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Correo</label>
                        <input
                            wire:model="inscription.email"
                            type="email"
                            placeholder="Ingresa tu correo electrónico"
                            required
                            class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Teléfono</label>
                        <input
                            wire:model="inscription.phone"
                            type="tel"
                            placeholder="Ingresa tu teléfono"
                            required
                            class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40">
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Convocatoria</label>
                            <select
                                id="convocation_id"
                                wire:model="inscription.convocation_id"
                                wire:change="onChangeConvocation()"
                                required
                                class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                            >
                                <option selected>Selecciona una opción</option>
                                @foreach ($convocations as $convocation)
                                    <option value="{{$convocation->id}}">{{$convocation->name}}</option>
                                @endforeach
                            </select>
                            @error('inscription.convocation_id') <span
                                class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Modalidad</label>
                            <select
                                wire:model="inscription.modality"
                                required
                                class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                            >
                                <option selected>Selecciona una opción</option>
                                @if($hasInPersonSpaceAvailable)
                                    <option value="1">Presencial</option>
                                @endif
                                @if($hasVirtualSpaceAvailable)
                                    <option value="2">Virtual</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Academic Role Select Input Start -->
                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Rol académico</label>
                            <select
                                wire:model="inscription.education"
                                required
                                class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40"
                            >
                                <option selected>Selecciona una opción</option>
                                <option value="1">Alumno</option>
                                <option value="2">Pasante</option>
                                <option value="3">Docente</option>
                            </select>
                        </div>
                        <!-- Academic Role Select Input End -->
                        <!-- School Select Input Start -->
                        <div>
                            <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Escuela</label>
                            <select
                                wire:model="inscription.school_id"
                                required
                                class="block w-full px-5 py-3 mt-2 text-gray-700 placeholder-gray-400 bg-white border
                                border-gray-200 rounded-md dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300
                                dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400
                                focus:outline-none focus:ring focus:ring-opacity-40"
                            >
                                <option selected>Selecciona una opción</option>
                                @foreach ($schools as $school)
                                    <option value="{{$school->id}}">{{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- School Select Input End -->
                    </div>
                    <div>
                        <label
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            for="file_input"
                        >Upload file
                        </label>
                        <input
                            wire:model="receipt"
                            id="file_input"
                            type="file"
                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                            cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600
                            dark:placeholder-gray-400"
                        >
                        @error('inscription.receipt_path') <span
                            class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <button
                        class="flex items-center justify-between w-full px-6 py-3 text-sm tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        <span>Registrarse </span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

