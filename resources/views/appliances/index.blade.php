 @extends('layouts.app')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="p-3">
        <main-header header-title="Mi Instalación" header-message="Gestiona los artefactos de tu hogar"></main-header>
    </div>
    <div class="my-auto mx-3 md:mx-0">
        <div class="md:w-3/4 lg:w-3/4 mx-auto overflow-x-auto bg-white my-2 md:my-0 border rounded-lg shadow-lg">
            <div class="flex flex-wrap flex-col md:flex-row justify-between items-center p-3">
                <p class="text-cyan-800 text-center text-md font-bold uppercase">Artefactos</p>
                <div class="">
                    {{ $appliances->links() }}
                </div>
                <a class="btn btn-outline no-underline" href="/appliances/create">Crear nuevo artefacto</a>
            </div>
            <table class="w-full">
                <tr>
                    {{-- <th class="bg-grey-050 align-left text-grey-darkest text-sm p-2 text-center">ID</th> --}}
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-left">Nombre</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Potencia[kWh]</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Inicio[h]</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Fin[h]</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center hidden md:table-cell">Duración[min]</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center hidden lg:table-cell">Estado</td>
                </tr>
                @foreach ($appliances as $appliance)
                    <tr>
                        {{-- <th class="align-left text-sm text-grey-darkest p-2 text-center">{{ $appliance->id }}</th> --}}
                        <td class="border-b text-sm p-3 hover:bg-grey-050">
                            <a class="no-underline text-grey-darkest" href="/appliances/{{ $appliance->id }}">{{ $appliance->name }}</a>
                        </td>
                        <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $appliance->power_kWh }}</td>
                        <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ ceil($appliance->start_oti / 5)}}</td>
                        <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ ceil($appliance->finish_oti / 5)}}</td>
                        <td class="border-b text-sm text-grey-darkest p-3 text-center hidden md:table-cell">{{ $appliance->length_operation * 12}}</td>
                        <td class="border-b text-sm text-grey-darkest p-3 text-center hidden lg:table-cell">{{ $appliance->status }}</td>
                    </tr>
                @endforeach
                {{-- <tr>
                    {{ $appliances->links() }}
                </tr> --}}
            </table>
        </div>
    </div>
@endsection