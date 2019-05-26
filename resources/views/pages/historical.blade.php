@extends('layouts.app')

@section('content')
    <div class="bg-grey-050 flex md:flex-1 flex-col p-3">
        <main-header></main-header>
        <div class="p-2">
            <tab-header class="flex-1 bg-white">
                <tab-content name="Cost" :selected="true">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-currency-euro" url="/api/estimatedCost"></historical-card>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-currency-euro" url="/api/realCost"></historical-card>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-currency-euro" url="/api/grossCost"></historical-card>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        {{-- <cost-graph class="md:w-2/3 md:mx-auto" url="/api/schedule" day="1"></cost-graph> --}}
                        <pv-graph class="md:w-2/3 md:mx-auto shadow-md" url="/api/pvSim"></pv-graph>
                    </div>
                </tab-content>
                <tab-content name="Energy">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-light" url="/api/consumedEnergy"></historical-card>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-battery-full" url="/api/pvRealUsed"></historical-card>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <historical-card icon="icon-currency-euro" url="/api/pvSimUsed"></historical-card>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        {{-- <cost-graph class="md:w-2/3 md:mx-auto" url="/api/schedule" day="1"></cost-graph> --}}
                        <pv-graph class="md:w-2/3 md:mx-auto shadow-md" url="/api/pvSim"></pv-graph>
                    </div>
                </tab-content>
            </tab-header>
        </div>
    </div>
@endsection