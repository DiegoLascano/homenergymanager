<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Prcu;

class grabData extends Controller
{
    /**
    * Prepare energy cost for the graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function getEnergyCost()
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
        
        $today = Carbon::today()->format('Y-m-d');
        $data = Prcu::where('date', $today)->get();

        $costArray = [];
        for ($i=1; $i < 25; $i++) { 
            $costArray[$i-1] = $data[0][$i];
        }
        $costArray[24] = $data[0][24];

        $energyCost['labels'] = collect($costArray)->keys();
        
        $datasets = [];
        $datasets['label'] = $data[0]['date'];
        $datasets['backgroundColor'] = $properties[0]['backgroundColor'];
        $datasets['borderColor'] = $properties[0]['borderColor'];
        $datasets['pointBackgroundColor'] = $properties[0]['pointBackgroundColor'];
        $datasets['pointBorderColor'] = $properties[0]['pointBorderColor'];
        $datasets['data'] = collect($costArray)->values();

        $energyCost['datasets'] = $datasets;

        return $energyCost;
    }

}
