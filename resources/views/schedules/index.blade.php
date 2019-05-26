@extends('layouts.app')

@section('sidebar')
    
@endsection

@section('content')
<div class="my-auto">
    <div class="md:w-3/4 lg:w-1/2 mx-auto overflow-x-auto bg-white my-2 md:my-0 border rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <p class="text-cyan-800 text-center text-md font-bold uppercase p-1 md:p-4 mt-2">Schedules</p>
            <div>
                {{ $schedules->links() }}
            </div>
            <form action="/schedules" method="POST">
                @csrf
                <button class="btn btn-outline no-underline md:mr-4 p-1 px-3 my-2 mb-2" type="submit">Create New Schedule</button>
            </form>
        </div>
        <table class="w-full">
            <tr>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-left">Id</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Chromosome</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Fitness</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Generations</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Status</td>
                <td class="bg-grey-050 font-semibold uppercase text-grey-darker text-xs p-2 text-center">Date</td>
            </tr>
            @foreach ($schedules as $schedule)
                <tr>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->id }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->chromosome }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->fitness }}</td>
                    <td class="border-b text-sm text-grey-darkest p-3 text-center">{{ $schedule->generations }}</td>
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