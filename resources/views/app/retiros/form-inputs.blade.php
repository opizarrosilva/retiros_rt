@php $editing = isset($retiro) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.select name="cliente_id" label="Cliente" required>
            @php $selected = old('cliente_id', ($editing ? $retiro->cliente_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Cliente</option>
            @foreach($clientes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select name="estadoretiro_id" label="Estadoretiro" required>
            @php $selected = old('estadoretiro_id', ($editing ? $retiro->estadoretiro_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Estadoretiro</option>
            @foreach($estadoretiros as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-3/12">
        <x-inputs.datetime
            name="fechacarga"
            label="Fechacarga"
            value="{{ old('fechacarga', ($editing ? optional($retiro->fechacarga)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="glosa" label="Glosa" maxlength="255" required
            >{{ old('glosa', ($editing ? $retiro->glosa : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User">
            @php $selected = old('user_id', ($editing ? $retiro->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
