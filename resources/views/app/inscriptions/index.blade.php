<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.inscriptions.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Inscription::class)
                            <a
                                href="{{ route('inscriptions.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.convocation_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.school_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.code')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.education')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.modality')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.receipt_path')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.inscriptions.inputs.approved')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($inscriptions as $inscription)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($inscription->convocation)->name
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($inscription->school)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->code ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->education ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->modality ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($inscription->receipt_path)
                                    <a
                                        href="{{ \Storage::url($inscription->receipt_path) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $inscription->approved ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $inscription)
                                        <a
                                            href="{{ route('inscriptions.edit', $inscription) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $inscription)
                                        <a
                                            href="{{ route('inscriptions.show', $inscription) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $inscription)
                                        <form
                                            action="{{ route('inscriptions.destroy', $inscription) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <div class="mt-10 px-4">
                                        {!! $inscriptions->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
