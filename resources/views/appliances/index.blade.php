 @extends('layouts.app')

@section('sidebar')
    {{-- @parent --}}
@endsection

@section('content')
    <div class="md:w-3/4 lg:w-1/2 mx-auto overflow-x-auto bg-white my-2 border rounded-lg shadow-lg">
        <div class="flex justify-between items-center">
            <p class="text-cyan-800 text-center text-md font-bold uppercase p-4">Appliances</p>
            <a class="btn btn-outline mr-4 no-underline" href="/appliances/create">Create New Application</a>
        </div>
        <table class="w-full">
            <tr>
                {{-- <th class="bg-grey-050 align-left text-grey-darkest text-sm p-2 text-center">ID</th> --}}
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-left">Name</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Power[kWh]</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Start[h]</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">End[h]</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Length[h]</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Status</td>
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
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $appliance->length_operation * 12}}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $appliance->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection