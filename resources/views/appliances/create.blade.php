@extends('layouts.app')

@section('sidebar')
    @parent
@endsection

@section('content')
{{-- <div class="container">
    <div class="min-h-screen md:flex">
        <aside class="bg-blue flex-no-shrink p-3">
            <p>Side bar side bar</p>
        </aside> --}}
        <div class="md:flex items-center flex-1">
            <div class="form-box mx-auto my-3">
                <p class="text-cyan-800 text-center text-md font-bold uppercase mb-4">Nuevo Artefacto</p>
                <form method="POST" action="/appliances">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
                                Artefacto
                            </label>
                            <input name="name" class="input-box" id="grid-first-name" type="text" placeholder="Aire acondicionado">
                            {{-- <p class="text-red text-xs italic">Please fill out this field.</p> --}}
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
                                Potencia [kW]
                            </label>
                            <input name="power_kWh" class="input-box" id="grid-last-name" type="text" placeholder="1.2">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                                inicio
                            </label>
                            <div class="relative">
                                <select name="start_oti" class="input-box" id="grid-state">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option>{{$i}}:00</option>
                                    @endfor
                                </select>
                                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
                                fin
                            </label>
                            <div class="relative">
                                <select name="finish_oti" class="input-box" id="grid-state">
                                    @for ($i = 1; $i < 25; $i++)
                                        <option>{{$i}}:00</option>
                                    @endfor
                                </select>
                                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
                                duracion [min]
                            </label>
                            <input name="length_operation" class="input-box" id="grid-zip" type="text" placeholder="30">
                        </div>
                    </div>
                    {{-- <button class="flex-no-shrink bg-teal hover:bg-teal-dark border-teal hover:border-teal-dark text-sm border-4 text-white mt-6 py-1 px-2 rounded" type="submit"> --}}
                    <div class="flex items-center justify-between">
                        <button class="btn btn-outline" type="submit">
                            Aceptar
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-cyan-600 hover:text-cyan-900 no-underline hover:underline" href="/appliances">
                            Cancelar
                        </a>
                    </div>
                </form>
            
                @include('partials.errors')
            </div>
        </div>
    {{-- </div>
</div> --}}
@endsection