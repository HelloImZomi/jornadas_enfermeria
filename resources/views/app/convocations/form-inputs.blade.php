@php $editing = isset($convocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $convocation->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.date
            name="inscription_start_date"
            label="Inscription Start Date"
            value="{{ old('inscription_start_date', ($editing ? optional($convocation->inscription_start_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.date
            name="inscription_end_date"
            label="Inscription End Date"
            value="{{ old('inscription_end_date', ($editing ? optional($convocation->inscription_end_date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="start_time"
            label="Start Time"
            value="{{ old('start_time', ($editing ? optional($convocation->start_time)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.datetime
            name="end_time"
            label="End Time"
            value="{{ old('end_time', ($editing ? optional($convocation->end_time)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.number
            name="presencial_limit"
            label="Presencial Limit"
            :value="old('presencial_limit', ($editing ? $convocation->presencial_limit : ''))"
            max="255"
            placeholder="Presencial Limit"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.number
            name="virtual_limit"
            label="Virtual Limit"
            :value="old('virtual_limit', ($editing ? $convocation->virtual_limit : ''))"
            max="255"
            placeholder="Virtual Limit"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.url
            name="zoom_url"
            label="Zoom Url"
            :value="old('zoom_url', ($editing ? $convocation->zoom_url : ''))"
            maxlength="255"
            placeholder="Zoom Url"
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.url
            name="whatsapp_url"
            label="Whatsapp Url"
            :value="old('whatsapp_url', ($editing ? $convocation->whatsapp_url : ''))"
            maxlength="255"
            placeholder="Whatsapp Url"
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="logo_path"
            label="Logo Path"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="logo_path"
            id="logo_path"
            class="form-control-file"
        />

        @if($editing && $convocation->logo_path)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($convocation->logo_path) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('logo_path') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>
