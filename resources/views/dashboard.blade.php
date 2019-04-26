@extends('layouts.app')

@section('content')
{{-- Este layout es para probar el diseño responsive usando Tailwind CSS --}}
    <main class="bg-grey-050 md:flex-1 p-3">
        <div class="flex justify-between items-center mb-4">
            <div class="flex flex-col font-sans text-grey-700 p-3">
                <p class="text-2xl mb-3">Welcome back, Diego</p>
                <p class="text-md">Datos Historicos</p>
            </div>
            <div class="font-sans text-lg text-grey-700 p-3">
                Date Picker
                {{-- <dropdown-component></dropdown-component> --}}
            </div>
        </div>
        <div class="flex flex-wrap">
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 p-3 mb-2">
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
            </div>
        </div>
        <div class="flex flex-wrap items-stretch w-full">
            <div class="w-full lg:w-2/3 rounded-sm p-3">
                <div class="m-auto">
                    <div class="graph-container bg-white rounded-md">
                        {{-- <consumption-graph url="/api/getSchedule" day="1"></consumption-graph>
                        <cost-graph url="/api/getEnergyCost" day="1"></cost-graph> --}}
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

