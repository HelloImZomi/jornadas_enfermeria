<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="flex justify-center min-h-screen">
            <div class="hidden bg-cover lg:block lg:w-2/5"
                 style="background-image: url('https://images.unsplash.com/photo-1494621930069-4fd4b2e24a11?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=715&amp;q=80')">
            </div>
            <div class="flex items-center w-full max-w-3xl p-8 mx-auto lg:px-12 lg:w-3/5">
                <x-partials.card @class('w-full p-6 bg-white rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800')>
                    <x-slot name="title">
                        <h1 class="text-2xl font-semibold tracking-wider text-gray-800 capitalize dark:text-white">
                            Inscribete ahora.
                        </h1>

                        <p class="mt-4 text-gray-500 dark:text-gray-400">
                            Let’s get you all set up so you can verify your personal account and begin setting up your profile.
                        </p>
                    </x-slot>
                    <x-form
                        method="POST"
                        action="{{ route('convocations.store') }}"
                        has-files
                        class="mt-4"
                    >
                        @include('components.forms.register')
                    </x-form>
                </x-partials.card>
            </div>
        </div>
    </section>
</x-app-layout>
