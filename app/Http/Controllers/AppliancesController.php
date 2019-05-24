<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appliance;

class AppliancesController extends Controller
{
    /**
    * Appliances of the function
    */
    public function __construct()
    {
        $this->middleware(['auth'])->only(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appliances = Appliance::where('owner_id', auth()->id())->get();
        // dd($appliances);
        // auth()->user()->appliances;
        return view('appliances.index', compact('appliances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appliances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $attributes = request()->validate([
            'name' => 'required',
            'start_oti' => 'required',
            'finish_oti' => 'required',
            'length_operation' => 'required',
            'power_kWh' => 'required',
        ]);

        // $inicio = explode(":", $attributes['start_oti'])[0];
        // dd($inicio*5);
        // convert hours to absolute timeSlots
        $attributes['start_oti'] = 5 * explode(":", $attributes['start_oti'])[0];
        $attributes['finish_oti'] = 5 * explode(":", $attributes['finish_oti'])[0];;
        $timeSlots = $attributes['length_operation'];
        $attributes['length_operation'] = ceil($timeSlots / 12);

        // dd($attributes);

        auth()->user()->appliances()->create($attributes);

        return redirect('/appliances');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appliance $appliance)
    {
        return view('appliances.show', compact('appliance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appliance $appliance)
    {
        return view('appliances.edit', compact('appliance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appliance $appliance)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'start_oti' => 'required',
            'finish_oti' => 'required',
            'length_operation' => 'required',
            'power_kWh' => 'required',
        ]);

        $attributes['start_oti'] = 5 * explode(":", $attributes['start_oti'])[0];
        $attributes['finish_oti'] = 5 * explode(":", $attributes['finish_oti'])[0];;
        $lot = $attributes['length_operation'];
        $attributes['length_operation'] = ceil($lot / 12);

        $appliance->update($attributes);

        return redirect('/appliances');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appliance $appliance)
    {
        $appliance->delete();

        return redirect('/appliances');
    }
}
