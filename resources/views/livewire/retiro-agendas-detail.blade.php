<div>
    <div>
        @can('create', App\Models\Agenda::class)
        <button class="button" wire:click="newAgenda">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Agenda::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.date
                            name="agenda.fecha"
                            label="Fecha"
                            wire:model.defer="agenda.fecha"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="w-full lg:w-6/12">
                        <x-inputs.select
                            name="agenda.bloquehorario_id"
                            label="Bloquehorario"
                            wire:model.defer="agenda.bloquehorario_id"
                        >
                            <option value="null" disabled>Bloque Horario</option>
                            @foreach($retiroBloquehorarios as $bloque)
                            <option value="{{ $bloque->id }}"  >{{ $bloque->horainicio }} - {{ $bloque->horafin }}</option>
                            @endforeach
                        </x-inputs.select>
                       
                    </x-inputs.group>
                   
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="agenda.glosa"
                            label="Glosa"
                            wire:model.defer="agenda.glosa"
                            maxlength="255"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="agenda.estadoagenda_id"
                            label="Estadoagenda"
                            wire:model.defer="agenda.estadoagenda_id"
                        >
                            <option value="null" disabled>Estado agenda</option>
                            @foreach($estadoagendas as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                        
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="agenda.user_id"
                            label="User"
                            wire:model.defer="agenda.user_id"
                        >
                            <option value="null" disabled>Usuario</option>
                            @foreach($retiroUsers as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.retiro_agendas.inputs.fecha')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.retiro_agendas.inputs.bloquehorario_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.retiro_agendas.inputs.glosa')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.retiro_agendas.inputs.estadoagenda_id')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.retiro_agendas.inputs.user_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($agendas as $agenda)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $agenda->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $agenda->fecha ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($agenda->bloquehorario)->horainicio ?? '-' }} - 
                        {{ optional($agenda->bloquehorario)->horafin ?? '-' }}                        
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $agenda->glosa ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($agenda->estadoagenda)->glosa ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ optional($agenda->user)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $agenda)
                            <button
                                type="button"
                                class="button"
                                wire:click="editAgenda({{ $agenda->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <div class="mt-10 px-4">{{ $agendas->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
