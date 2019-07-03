@extends('layouts.app')

@section('content')
    <main class="bg-grey-050 md:flex-1 p-3">
        <main-header header-title="Bienvenido, {{ auth()->user()->name }}" header-message="Gestiona tu instalación"></main-header>

        <div class="md:p-3">
            <tab-header class="flex-1 bg-white">
                <tab-content name="Costo" :selected="true">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pr-3">
                            <daily-cost icon="icon-currency-euro" url="/api/grossCost"></daily-cost>
                        </div> 
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 md:p-3">
                            <daily-cost icon="icon-currency-euro" url="/api/realCost"></daily-cost>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pl-3">
                            <daily-savings icon="icon-wallet" url="/api/costSavings"></daily-savings>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        <realtime-graph class="md:w-2/3 md:mx-auto" title="Tendencia de costo [¢/kWh]" url="/api/realtimeCost"></realtime-graph>
                    </div>
                </tab-content>
                <tab-content name="Energía">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pr-3">
                            <daily-energy icon="icon-light" url="/api/consumedEnergy"></daily-energy>
                        </div>  
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 md:p-3">
                            <daily-savings icon="icon-battery-half" url="/api/pvRealGenerated"></daily-savings>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pl-3">
                            <daily-savings icon="icon-battery-full" url="/api/energySavings"></daily-savings>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        <realtime-graph class="md:w-2/3 md:mx-auto" title="Tendencia de energía consumida [kWh]" url="/api/realtimeEnergy"></realtime-graph>
                    </div>
                </tab-content>
            </tab-header>
        </div>
    </main>
@endsection

