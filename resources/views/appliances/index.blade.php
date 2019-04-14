 @extends('layouts.body')

@section('body-sidebar')
    <p>Sidebaaaarr</p>
@endsection

@section('body-main')
    <div class="md:w-3/4 mx-auto overflow-x-auto bg-white border rounded-lg shadow-lg">
        <p class="text-cyan-800 text-center text-md font-bold uppercase p-4">Appliances</p>
        <table class="w-full">
            <tr>
                <th class="bg-grey-300 align-left p-1 text-center">ID</th>
                <th class="bg-grey-300 align-left p-1 text-center">Name</th>
                <th class="bg-grey-300 align-left p-1 text-center">Power[kWh]</th>
                <th class="bg-grey-300 align-left p-1 text-center">Start[h]</th>
                <th class="bg-grey-300 align-left p-1 text-center">End[h]</th>
                <th class="bg-grey-300 align-left p-1 text-center">Length[h]</th>
                <th class="bg-grey-300 align-left p-1 text-center">Status</th>
            </tr>
            @foreach ($appliances as $appliance)
                <tr>
                    <th class="border align-left p-1 text-center">{{ $appliance->id }}</th>
                    <td class="border align-left p-1">{{ $appliance->name }}</td>
                    <td class="border align-left p-1 text-center">{{ $appliance->power_kWh }}</td>
                    <td class="border align-left p-1 text-center">{{ ceil($appliance->start_oti / 5)}}</td>
                    <td class="border align-left p-1 text-center">{{ ceil($appliance->finish_oti / 5)}}</td>
                    <td class="border align-left p-1 text-center">{{ $appliance->length_operation * 12}}</td>
                    <td class="border align-left p-1 text-center">{{ $appliance->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection