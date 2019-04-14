@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <div class="md:min-h-screen md:flex md:flex-row">
            <div class="bg-white p-3">
                Here is the sidebar
            </div>
            <div class="md:flex-1 p-3">
                <div class="mx-auto lg:max-w-lg md:max-w-md bg-white border border-solid border-cyan-600 rounded-lg">
                    {{-- <p class="bg-cyan-900">Here the graphs</p> --}}
                    <pv-graph url="/api/getPV" day1 = "1" day2 = "2"></pv-graph>
                </div>
            </div>
        </div>
    </div>    
@endsection