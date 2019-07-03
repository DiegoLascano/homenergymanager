@extends('layouts.app')

@section('content')
<div class="bg-grey-050 flex md:flex-1 flex-col p-3">
    <main-header header-title="Gráficas" header-message="Compara de forma visual los datos almacenados."></main-header>
    <div class="md:p-3">
        <tab-header class="flex-1 bg-white">
            <tab-content name="Energía PV simulada" :selected="true">
                <div class="bg-grey-050 pt-3">
                    <compare-graph class="md:w-2/3 md:mx-auto bg-white mb-2" title="Energía PV simulada [kWh]" url="{{ route('pvSim') }}"></compare-graph>
                </div>
            </tab-content>
            <tab-content name="Energía PV real">
                <div class="bg-grey-050 pt-3">
                    <compare-graph class="md:w-2/3 md:mx-auto bg-white mb-2" title="Energía PV real [kWh]" url="{{ route('pvGenReal') }}"></compare-graph>
                </div>
            </tab-content>
            <tab-content name="Costo de la energía">
                <div class="bg-grey-050 pt-3">
                    <compare-graph class="md:w-2/3 md:mx-auto bg-white mb-2" title="Costo diario [¢/kWh]" url="{{ route('energyCost') }}"></compare-graph>
                </div>
            </tab-content>
        </tab-header>
    </div>
</div>
@endsection