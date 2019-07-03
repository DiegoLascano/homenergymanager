<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\DailyPV;
use App\Events\PvUpdated;
use App\Events\FlashMessage;

class DailyPVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now()->format('Y-m-d');
        $dailyPV = DailyPV::where('date', $date)->get();
        // $dailyPV['date'] = $data[0]['date'];
        // for ($i = 1; $i < 25; $i++) { 
        //     $dailyPV[$i-1] = $data[0][$i];
        // }
        // $dailyPV = $data[0];
        // dd($data[0]);
        // dd($dailyPV['date']);
        return view('dailyPV.index', compact('dailyPV'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Hola desde create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'Hola desde store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Hola desde show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyPV $dailyPV)
    {
        return view('dailyPV.edit', compact('dailyPV'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyPV $dailyPV)
    {
        $dailyPV->update($request->all());
        PvUpdated::dispatch($dailyPV);
        FlashMessage::dispatch('success', 'PV data updated');
        return redirect('/dailyPV');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'Hola desde destroy';
    }
}
