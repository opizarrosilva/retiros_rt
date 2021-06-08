@php $editing = isset($evidencia) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select
            name="tipoevidencia_id"
            label="Tipo Evidencia"
            required
        >
            @php $selected = old('tipoevidencia_id', ($editing ? $evidencia->tipoevidencia_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Tipoevidencia</option>
            @foreach($tipoevidencias as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-8/12">
        <x-inputs.url
            name="url"
            label="Url"
            value="{{ old('url', ($editing ? $evidencia->url : '')) }}"
            maxlength="255"
            required
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="retiro_id" label="Retiro" required>
            @php $selected = old('retiro_id', ($editing ? $evidencia->retiro_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Retiro</option>
            @foreach($retiros as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $evidencia->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
