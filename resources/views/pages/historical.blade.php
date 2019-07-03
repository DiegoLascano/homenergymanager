@extends('layouts.app')

@section('content')
    <div class="bg-grey-050 flex md:flex-1 flex-col p-3">
        <main-header header-title="Datos historicos" header-message="Analiza los resultados de días anteriores" :show-calendar="true"></main-header>
        <div class="md:p-3">
            <tab-header class="flex-1 bg-white">
                <tab-content name="Costo" :selected="true">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pr-3">
                            <historical-cost icon="icon-currency-euro" url="/api/grossCost"></historical-cost>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 md:p-3">
                            <historical-cost icon="icon-currency-euro" url="/api/realCost"></historical-cost>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pl-3">
                            <historical-savings icon="icon-wallet" url="/api/costSavings"></historical-savings>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        <historical-graph class="md:w-2/3 md:mx-auto bg-white" title="Tendencia de costo [¢/kWh]" url="/api/realCostData"></historical-graph>
                    </div>
                </tab-content>
                <tab-content name="Energía">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pr-3">
                            <historical-energy icon="icon-light" url="/api/consumedEnergy"></historical-energy>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 md:p-3">
                            <historical-savings icon="icon-battery-half" url="/api/pvRealGenerated"></historical-savings>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 py-3 md:pl-3">
                            <historical-savings icon="icon-battery-full"url="/api/energySavings"></historical-savings>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        <historical-graph class="md:w-2/3 md:mx-auto bg-white" title="Tendencia de energía consumida [kWh]" url="/api/energyData"></historical-graph>
                    </div>
                </tab-content>
            </tab-header>
        </div>
    </div>
@endsection