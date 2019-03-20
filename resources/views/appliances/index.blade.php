@extends('layouts.app')

@section('content')
    <h1>Appliances Index</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Power</th>
                <th scope="col">Operation Interval</th>
                <th scope="col">Operation Length</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appliances as $appliance)
                <tr>
                    <th scope="row">{{ $appliance->id }}</th>
                    <td>{{ $appliance->name }}</td>
                    <td>{{ $appliance->power_kWh }}</td>
                    <td>{{ $appliance->start_oti / 5}} - {{ $appliance->finish_oti / 5}}</td>
                    <td>{{ $appliance->length_operation / 5}}</td>
                    <td>{{ $appliance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection