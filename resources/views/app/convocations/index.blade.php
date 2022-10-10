<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.convocations.index_title')
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
                            @can('create', App\Models\Convocation::class)
                            <a
                                href="{{ route('convocations.create') }}"
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
                                    @lang('crud.convocations.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.inscription_start_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.inscription_end_date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.start_time')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.end_time')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.convocations.inputs.presencial_limit')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.convocations.inputs.virtual_limit')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.zoom_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.whatsapp_url')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.convocations.inputs.logo_path')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($convocations as $convocation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $convocation->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $convocation->inscription_start_date ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $convocation->inscription_end_date ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $convocation->start_time ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $convocation->end_time ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $convocation->presencial_limit ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $convocation->virtual_limit ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a
                                        class="underline cursor-pointer"
                                        target="_blank"
                                        href="{{ $convocation->zoom_url }}"
                                        >{{ $convocation->zoom_url ?? '-' }}</a
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a
                                        class="underline cursor-pointer"
                                        target="_blank"
                                        href="{{ $convocation->whatsapp_url }}"
                                        >{{ $convocation->whatsapp_url ?? '-'
                                        }}</a
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($convocation->logo_path)
                                    <a
                                        href="{{ \Storage::url($convocation->logo_path) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
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
                                        @can('update', $convocation)
                                        <a
                                            href="{{ route('convocations.edit', $convocation) }}"
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
                                        @endcan @can('view', $convocation)
                                        <a
                                            href="{{ route('convocations.show', $convocation) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $convocation)
                                        <form
                                            action="{{ route('convocations.destroy', $convocation) }}"
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
                                <td colspan="11">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="11">
                                    <div class="mt-10 px-4">
                                        {!! $convocations->render() !!}
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
