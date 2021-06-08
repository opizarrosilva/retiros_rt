@php $editing = isset($agenda) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.date
            name="fecha"
            label="Fecha"
            value="{{ old('fecha', ($editing ? optional($agenda->fecha)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.select
            name="bloquehorario_id"
            label="Bloque horario"
            required
        >
            @php $selected = old('bloquehorario_id', ($editing ? $agenda->bloquehorario_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Bloquehorario</option>
            @foreach($bloquehorarios as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="glosa"
            label="Informacion Adicional"
            value="{{ old('glosa', ($editing ? $agenda->glosa : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="retiro_id" label="Retiro" required>
            @php $selected = old('retiro_id', ($editing ? $agenda->retiro_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Retiro</option>
            @foreach($retiros as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $agenda->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
