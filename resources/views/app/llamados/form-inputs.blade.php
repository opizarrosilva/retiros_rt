@php $editing = isset($llamado) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="estadollamado_id" label="Estadollamado" required>
            @php $selected = old('estadollamado_id', ($editing ? $llamado->estadollamado_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Estadollamado</option>
            @foreach($estadollamados as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="retiro_id" label="Retiro" required>
            @php $selected = old('retiro_id', ($editing ? $llamado->retiro_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Retiro</option>
            @foreach($retiros as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $llamado->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
