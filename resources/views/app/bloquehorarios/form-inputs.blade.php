@php $editing = isset($bloquehorario) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.time
            name="horainicio"
            label="Hora inicio"
            value="{{ old('horainicio', ($editing ? optional($bloquehorario->horainicio)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.time>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.time
            name="horafin"
            label="Hora fin"
            value="{{ old('horafin', ($editing ? optional($bloquehorario->horafin)->format('Y-m-d\TH:i:s') : '')) }}"
            required
        ></x-inputs.time>
    </x-inputs.group>
</div>
