@php $editing = isset($estadollamado) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="glosa"
            label="Glosa"
            value="{{ old('glosa', ($editing ? $estadollamado->glosa : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
