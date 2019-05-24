@extends('layouts.app')

@section('content')
    <main class="bg-grey-050 md:flex-1 p-3">
        <div class="flex justify-between items-center mb-4">
            <div class="flex flex-col font-sans text-grey-700 p-3">
                <p class="text-2xl mb-3">Welcome back, Diego</p>
                <p class="text-md">Datos Historicos</p>
            </div>
            {{-- <div class="font-sans text-lg text-grey-700 p-3">
                Date Picker
            </div> --}}
        </div>
        <div class="flex flex-wrap">
            {{-- <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 p-3 mb-2">
                @include('cards.consumo')
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 p-3 mb-2">
                @include('cards.facturado')
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 p-3 mb-2">
                @include('cards.facturado')
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 p-3 mb-2">
                @include('cards.facturado')
            </div> --}}
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-average icon="icon-currency-euro" url="/api/estimatedCost"></daily-average>
            </div> 
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-cost icon="icon-currency-euro" url="/api/realCost"></daily-cost>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-cost icon="icon-currency-euro" url="/api/grossCost"></daily-cost>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-average icon="icon-battery-half" url="/api/pvRealUsed"></daily-average>
            </div>  
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-cost icon="icon-battery-full" url="/api/pvSimUsed"></daily-cost>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                <daily-cost icon="icon-light" url="/api/consumedEnergy"></daily-cost>
            </div>
        </div>
        <div class="flex flex-wrap items-stretch w-full">
            <div class="w-full lg:w-2/3 rounded-sm p-3">
                <div class="m-auto">
                    <div class="graph-container">
                        <realtime-graph url="/api/realtimeData"></realtime-graph>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3 rounded-sm p-3 m-auto">
                <div class="bg-white">
                    Table
                </div>
            </div>
        </div>
    </main>
@endsection

