<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="name"
            placeholder="Ingresa tu nombre completo"
            required
        ></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.email
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="email"
            placeholder="Ingresa tu correo electrónico"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Convocatoria</label>
        <x-inputs.select
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="convocation_id"
            required
        >
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Convocation</option>
            @foreach($convocations as $convocation)
                <option value="{{ $convocation->id }}">{{ $convocation->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Escuela</label>
        <x-inputs.select
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="convocation_id"
            required
        >
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the School</option>
            @foreach($schools as $school)
                <option value="{{ $school->id }}">{{ $school->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Rol Académico</label>
        <x-inputs.select
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="convocation_id"
            required
        >
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Convocation</option>
            @foreach($convocations as $convocation)
                <option value="{{ $convocation->id }}">{{ $convocation->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <label class="block mb-2 text-sm text-gray-600 dark:text-gray-200">Modalidad</label>
        <x-inputs.select
            @class('block w-full rounded-lg border-none px-3 py-2 shadow-sm ring-1 ring-inset transition duration-75
                    focus:ring-2 focus:ring-inset focus:ring-primary-500 disabled:opacity-70 sm:py-2.5 sm:text-sm
                    dark:bg-gray-700 dark:text-white dark:focus:ring-primary-500 ring-gray-300 dark:ring-gray-600')
            name="convocation_id"
            required
        >
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the School</option>
            @foreach($schools as $school)
                <option value="{{ $school->id }}">{{ $school->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    <p>{{Request::input('name')}}</p>
</div>

