@php $editing = isset($modificacione) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.select name="atributo_id" label="Atributo" required>
            @php $selected = old('atributo_id', ($editing ? $modificacione->atributo_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Atributo</option>
            @foreach($atributos as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-8/12">
        <x-inputs.text
            name="glosa"
            label="Glosa"
            value="{{ old('glosa', ($editing ? $modificacione->glosa : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="retiro_id" label="Retiro" required>
            @php $selected = old('retiro_id', ($editing ? $modificacione->retiro_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Retiro</option>
            @foreach($retiros as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $modificacione->user_id : '{{$user->id}}')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
