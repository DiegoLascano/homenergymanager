<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ScheduleRequested;
use App\Jobs\SendScheduleGeneratedNotification;
use App\Events\ScheduleGenerated;
use App\Schedule;

class SchedulesController extends Controller
{
    /**
    * Schedules Controller constructor
    */
    public function __construct()
    {
        $this->middleware(['auth'])->only(['index', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = auth()->user()->schedules;
        // dd($schedules);  
        return view('schedules.index', compact('schedules'));
        // $message = ['name' => 'Diego', 'lastname' => 'Lascano'];
        // event(new ScheduleGenerated($message));
        // dispatch(new SendScheduleGeneratedNotification)->delay(now()->addSeconds(5));
        // return "Hello from SchedulesController Index method";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = ['status' => 'IN PROGRESS'];

        $schedule = auth()->user()->schedules()->create($attributes);
        // dump($attributes);
        // dd($schedule);
        event(new ScheduleRequested($schedule));

        return redirect()->back()->with('message', 'Schedule is being generated');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
