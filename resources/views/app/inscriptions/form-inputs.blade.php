@php $editing = isset($inscription) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="convocation_id" label="Convocation" required>
            @php $selected = old('convocation_id', ($editing ? $inscription->convocation_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Convocation</option>
            @foreach($convocations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="school_id" label="School" required>
            @php $selected = old('school_id', ($editing ? $inscription->school_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the School</option>
            @foreach($schools as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $inscription->code : ''))"
            placeholder="Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $inscription->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $inscription->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="education" label="Education">
            @php $selected = old('education', ($editing ? $inscription->education : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >Estudiante</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >Pasante</option>
            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >Docente</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select name="modality" label="Modality">
            @php $selected = old('modality', ($editing ? $inscription->modality : '')) @endphp
            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >Presencial</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >Virtual</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="receipt_path"
            label="Receipt Path"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="receipt_path"
            id="receipt_path"
            class="form-control-file"
        />

        @if($editing && $inscription->receipt_path)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($inscription->receipt_path) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('receipt_path')
        @include('components.inputs.partials.error') @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="approved"
            label="Approved"
            :checked="old('approved', ($editing ? $inscription->approved : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
