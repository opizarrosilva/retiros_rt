@php $editing = isset($estadoretiro) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="glosa"
            label="Estado Retiro"
            value="{{ old('glosa', ($editing ? $estadoretiro->glosa : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
