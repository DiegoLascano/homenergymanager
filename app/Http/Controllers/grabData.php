<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Prcu;
use App\PowerGenerated;

class grabData extends Controller
{
    /**
    * Get the property for the graphs
    *
    */
    public function getGraphProperties()
    {
        $properties = [
            [
                'backgroundColor' => 'rgba(77, 184, 255,0.1)',
                'borderColor' => 'rgba(77, 184, 255,1)',
                'pointBackgroundColor' => 'rgba(0,153,255,0.1)',
                'pointBorderColor' => 'rgba(0,153,255,1)',
            ],
            [
                'backgroundColor' => 'rgba(255,98,204,0.1)',
                'borderColor' => 'rgba(255,98,204,1)',
                'pointBackgroundColor' => 'rgba(230,0,157,0.1)',
                'pointBorderColor' => 'rgba(230,0,157,1)',
            ],
        ];
        return $properties;
    }
    
    /**
    * Prepare energy cost data for the graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function getEnergyCost()
    {
        $day1 = request('day1') ?: 1;
        if (request()->has('day2')) {
            $day2 = request('day2') ?: 50;
        }

        // $properties = $this->getGraphProperties();

        // $today = Carbon::today()->format('Y-m-d');
        $data[0] = Prcu::where('id', $day1)->get();
        if (isset($day2)) {
            $data[1] = Prcu::where('id', $day2)->get();
        }
        // dd($data[0]);

        $costArray = [];
        $datasets = [];
        foreach ($data as $key => $prcu) {
            for ($i=1; $i < 25; $i++) { 
                $costArray[$i-1] = $prcu[0][$i];
            }
            $costArray[24] = $prcu[0][24];

            $datasets[$key]['label'] = $prcu[0]['date'];
            $datasets[$key]['data'] = collect($costArray)->values();
        }

        $energyCost['labels'] = collect($costArray)->keys();
        
        // dd($costArray[0]);
        
        
        // $datasets[0]['backgroundColor'] = $properties[0]['backgroundColor'];
        // $datasets[0]['borderColor'] = $properties[0]['borderColor'];
        // $datasets[0]['pointBackgroundColor'] = $properties[0]['pointBackgroundColor'];
        // $datasets[0]['pointBorderColor'] = $properties[0]['pointBorderColor'];
        
        $energyCost['datasets'] = $datasets;
        // dd($energyCost);

        return $energyCost;
    }

    /**
    * Prepare PV Generated energy for the graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function getPV()
    {
        $day1 = request('day1') ?: 1;
        if (request()->has('day2')) {
            $day2 = request('day2') ?: 2;
        }

        // $properties = $this->getGraphProperties();

        // $today = Carbon::today()->format('Y-m-d');
        $data[0] = PowerGenerated::where('id', $day1)->get();
        if (isset($day2)) {
            $data[1] = PowerGenerated::where('id', $day2)->get();
        }

        $pvArray = [];
        $datasets = [];
        foreach ($data as $key => $pvGen) {
            for ($i=1; $i < 25; $i++) { 
                $pvArray[$i-1] = $pvGen[0][$i];
            }
            $pvArray[24] = $pvGen[0][24];

            $datasets[$key]['label'] = $pvGen[0]['date'];
            $datasets[$key]['data'] = collect($pvArray)->values();
        }

        $PVGenerated['labels'] = collect($pvArray)->keys();

        $PVGenerated['datasets'] = $datasets;
        // dd($PVGenerated);

        return $PVGenerated;
    }

}
