@extends('layouts.app')

@section('sidebar')
    {{-- @parent --}}
@endsection

@section('content')
    {{-- <h3>Index {{ Carbon\Carbon::now()->format('Y-m-d') }}</h3> --}}
    <div class="flex flex-col">
        <div class="rounded bg-cyan-600 p-2 mx-auto my-2">
            {{ $dailyPV[0]['date'] }}
        </div>
        <div class="rounded bg-cyan-600 p-2 mx-auto my-2">
            <a class="text-white no-underline" href="/dailyPV/{{ $dailyPV[0]['id'] }}/edit">Edit</a>
        </div>
        <div class="mx-auto overflow-x-auto bg-white border rounded-lg shadow-lg my-2">
            <table class="w-full">
                <tr>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Hora</td>
                    <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">PV Generada</td>
                </tr>
                @for ($i = 1; $i < 25; $i++)
                    <tr>
                        <td class="border-b text-sm text-grey-darkest p-2 text-center">{{ $i }}</td>
                        <td class="border-b text-sm text-grey-darkest p-2 text-center">{{ $dailyPV[0][$i] }}</td>
                    </tr>
                @endfor
            </table>
        </div>
    </div>
@endsection