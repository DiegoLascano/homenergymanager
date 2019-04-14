@extends('layouts.app')

@section('content')
{{-- Este layout es para probar el diseño responsive usando Tailwind CSS --}}
<div id="app" class="container">
    <div class="md:min-h-screen md:flex md:flex-col">
        <div class="md:flex md:flex-1">
            <aside class="bg-blue p-3">
                Space for Widgets
            </aside>
            <main class="bg-grey-100 md:flex-1 p-3">
                <div class="flex flex-wrap">
                    <div class="w-full p-3">
                        <div class="md:mb-2 md:mx-2">
                            <div class="lg:max-w-lg md:max-w-md mx-auto bg-white border border-solid border-cyan-600 rounded-lg">
                                <cost-graph url="/api/getEnergyCost" day="1"></cost-graph>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="w-full p-3">
                        <div class="md:mb-2 md:mx-2">
                            <div class="graph-container bg-white border-2 border-solid border-grey rounded-lg">
                                <line-graph url="/api/getEnergyCost"></line-graph>
                            </div>
                        </div>
                    </div> --}}

                    <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                        <div class="bg-grey-light md:mb-2 md:mx-2">
                            <p>Product Feature</p>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                        <div class="bg-grey-light md:mb-2 md:mx-2">
                            <p>Product Feature</p>
                        </div>
                    </div>

                    <div class="w-full sm:w-1/2 md:w-1/4 p-3">
                        <div class="bg-grey-light md:mb-2 md:mx-2">
                            <p>Product Feature</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
