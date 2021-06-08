@php $editing = isset($cliente) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="glosa"
            label="Nombre Cliente"
            value="{{ old('glosa', ($editing ? $cliente->glosa : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="codigointerno"
            label="Codigo Interno"
            value="{{ old('codigointerno', ($editing ? $cliente->codigointerno : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>
</div>
