<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.retiros.edit_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('retiros.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('retiros.update', $retiro) }}"
                    class="mt-4"
                >
                    @include('app.retiros.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('retiros.index') }}" class="button">
                            <i
                                class="mr-1 icon ion-md-return-left text-primary"
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('retiros.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\Modificacione::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Modificaciones </x-slot>

                <livewire:retiro-modificaciones-detail :retiro="$retiro" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Agenda::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Agendas </x-slot>

                <livewire:retiro-agendas-detail :retiro="$retiro" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Evidencia::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Evidencias </x-slot>

                <livewire:retiro-evidencias-detail :retiro="$retiro" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\Llamado::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Llamados </x-slot>
                <livewire:retiro-llamados-detail :retiro="$retiro" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
