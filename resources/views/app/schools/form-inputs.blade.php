@php $editing = isset($school) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $school->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="visible"
            label="Visible"
            :checked="old('visible', ($editing ? $school->visible : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
