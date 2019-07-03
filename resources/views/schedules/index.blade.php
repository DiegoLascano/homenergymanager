@extends('layouts.app')

@section('sidebar')
    @parent
@endsection

@section('content')
<div class="p-3">
    <main-header header-title="Mis cronogramas" header-message="Gestiona tus cronogramas"></main-header>
</div>
<div class="my-auto mx-3 md:mx-0">
    <div class="md:w-3/4 mx-auto overflow-x-auto bg-white my-2 md:my-0 border rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row justify-between items-center p-3">
            <p class="text-cyan-800 text-center text-md font-bold uppercase">Cronogramas</p>
            <div>
                {{ $schedules->links() }}
            </div>
            <form action="/schedules" method="POST">
                @csrf
                <button class="btn btn-outline no-underline" type="submit">Crear nuevo cronograma</button>
            </form>
        </div>
        <table class="w-full">
            <tr>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-left">Id</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center hidden lg:table-cell">Cromosoma</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center hidden sm:table-cell">Fitness</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center hidden lg:table-cell">Generaciones</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Estado</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Fecha</td>
            </tr>
            @foreach ($schedules as $schedule)
                <tr>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->id }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center hidden lg:table-cell">{{ $schedule->chromosome }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center hidden sm:table-cell">{{ $schedule->fitness }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center hidden lg:table-cell">{{ $schedule->generations }}</td>
                    @if ( $schedule->status == 'COMPLETED')
                        <td class="font-semibold border-b text-xs p-3 text-center">
                            <div class="bg-cyan-100 text-cyan-600 border-cyan-100 rounded-full p-1 px-2">
                                {{ $schedule->status }}
                            </div>    
                        </td>
                    @else                        
                        <td class="font-semibold border-b text-xs p-3 text-center">
                            <div class="bg-yellow-100 text-yellow-800 border-yellow-100 rounded-full p-1 px-2">
                                {{ $schedule->status }}
                            </div>    
                        </td>
                    @endif
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection