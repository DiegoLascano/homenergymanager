@extends('layouts.app')

@section('sidebar')
    {{-- @parent --}}
@endsection

@section('content')
    <form action="/dailyPV/{{ $dailyPV['id'] }}" method="POST">
        <div class="flex flex-col">
            @method('PATCH')
            @csrf
            <div class="rounded bg-cyan-600 p-2 mx-auto my-2">
                <button class="text-white" type="submit">Actualizar</button>
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
                            <td class="border-b text-sm p-2">
                                <input class="text-center text-grey-dark" type="text" name="{{ $i }}" value="{{ $dailyPV[$i] }}">
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    </form>
@endsection