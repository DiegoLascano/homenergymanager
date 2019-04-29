@extends('layouts.app')

@section('content')
    <div class="bg-grey-050 flex md:flex-1 flex-col p-3">
        <main-header></main-header>
        <div class="p-2">
            <tab-header class="flex-1 bg-white">
                <tab-content name="Cost" :selected="true">
                    <div class="flex flex-wrap">
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <daily-average icon="icon-light" title="Energia consumida" url=""></daily-average>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <daily-average icon="icon-battery-full" title="Energia generada" url=""></daily-average>
                        </div>
                        <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 p-3 mb-2">
                            <daily-average icon="icon-currency-euro" title="Energia ahorrada" url=""></daily-average>
                        </div>
                    </div>
                    <div class="md:flex items-center">
                        {{-- <cost-graph class="md:w-2/3 md:mx-auto" url="/api/getSchedule" day="1"></cost-graph> --}}
                        <pv-graph class="md:w-2/3 md:mx-auto" url="/api/getPV" day="1"></pv-graph>
                    </div>
                </tab-content>
                <tab-content name="Energy">
                    <h3  class="text-grey-700 text-sm font-thin">Here goes the content for Energy</h3>
                </tab-content>
            </tab-header>
        </div>
    </div>
@endsection