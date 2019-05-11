<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Prcu;
use App\PowerGenerated;
use App\Schedule;
use App\Appliance;

class grabData extends Controller
{
    /**
    * Get the property for the graphs
    *
    */
    /* public function getGraphProperties()
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
    } */

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
        $today = Carbon::today()->format('Y-m-d');
        $date = request('date') ?: $today;

        // dd($date);

        // if (request()->has('day2')) {
        //     $day2 = request('day2') ?: 2;
        // }

        // $properties = $this->getGraphProperties();

        $data[0] = PowerGenerated::where('date', $date)->get();
        // if (isset($day2)) {
        //     $data[1] = PowerGenerated::where('id', $day2)->get();
        // }

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



    
    /**
    * Get the PV energy generated for a day
    *
    */
    public function getPVGA()
    {
        $energyPV = [];
        $m = 0;
        $day = Carbon::now()->format('Y-m-d');
        $PV = PowerGenerated::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $day)->get();
                        
        // Generate a vector with 120 values 
        for ($i=1; $i < 25; $i++) { 
            $hourlyPV = $PV[0][$i];

            // PV energy for each timeslot
            for ($j=1; $j < 6; $j++) { 
                $energyPV[$m] = $hourlyPV / 5;
                $m++;
            }
        }
        return $energyPV;
    }

    /**
    * Get the cost of energy from DB for today Prcu
    *
    */
    public function getEnergyCostGA()
    {
        $energyCost = [];
        $m = 0;
        $day = Carbon::now()->format('Y-m-d');
        $costs = Prcu::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $day)->get();
                        
        // Generate a vector with 120 values 
        for ($i=1; $i < 25; $i++) { 
            $hourlyCost = $costs[0][$i];
            for ($j=1; $j < 6; $j++) { 
                $energyCost[$m] = $hourlyCost;
                $m++;
            }
        }
        return $energyCost;
    }


    /**
    * Get the last schedule for a user.
    *
    * @param Type $var var explanation
    */
    public function getSchedule()
    {
        $chromosome = Schedule::latest()->first()['chromosome'];
        $schedule = explode(",", $chromosome);

        $energyCost = $this->getEnergyCostGA(); //get energy cost of today
        $energyPV = $this->getPVGA(); //get pv generated (SAM data) of today

        $appliances = Appliance::where('status', '0')->get();
        $appliancesCount = count($appliances);

        $lastTimeslot = 120;
        $i = 0;
        $pscd = array_fill(0, $lastTimeslot, 0);

        $sumEnergia = array_fill(0, $lastTimeslot, 0);
        $sumEnergiaPV = array_fill(0, $lastTimeslot, 0);

        $hourlyPV = array_fill(0, 24, 0);
        $hourlyNoPV = array_fill(0, 24, 0);
        foreach ($appliances as $appliance) {
            $start = $schedule[$i];
            $la = $appliance->length_operation;
            $finish = $start + $la;
            $power = $appliance->power_kWh;

            $consumptionMatrix[$i] = array_fill(0, $lastTimeslot, 0);
            for ($j = $start; $j < $finish; $j++) { 
                $consumptionMatrix[$i][$j] = $power / ($lastTimeslot / 24);
            }
            $i++;
        }
        
        for ($m = 0; $m < $lastTimeslot; $m++) { 
            for ($n = 0; $n < $appliancesCount; $n++) { 
                $pscd[$m] =  $pscd[$m] + $consumptionMatrix[$n][$m];
            }
            $netPscd = $pscd[$m] - $energyPV[$m];
            if ($netPscd < 0) $netPscd = 0;
            $sumEnergiaPV[$m] = $netPscd * $energyCost[$m];
            $sumEnergia[$m] = $pscd[$m] * $energyCost[$m];
        }
        $hourlySumPV = 0;
        $hourlySumNoPV = 0;
        $j = 0;
        for ($i = 0; $i < $lastTimeslot; $i++) { 
            $hourlySumPV += $sumEnergiaPV[$i];
            $hourlySumNoPV += $sumEnergia[$i];
            // cada 5 timeslots totaliza la suma de 1 hora
            if ((($i+1) % 5) == 0) {
                $hourlyPV[$j] = $hourlySumPV;
                $hourlyNoPV[$j] = $hourlySumNoPV;
                $hourlySumPV = 0;
                $hourlySumNoPV = 0;
                $j++;
            }
        }
        $datasets[0]['label'] = 'PV';
        $datasets[0]['data'] = collect($hourlyPV)->values();
        $datasets[1]['label'] = 'No PV';
        $datasets[1]['data'] = collect($hourlyNoPV)->values();
        $consumption['labels'] = collect($hourlyPV)->keys();
        $consumption['datasets'] = $datasets;
        // dump(array_sum($sumEnergiaPV));
        // dump(array_sum($hourlyPV));
        // dump(array_sum($sumEnergia));
        // dd($hourlyPV);

        return $consumption;
    }

    /**
    * Prepare energy cost data for the realtime graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function getRealtimeData()
    {
        $consumption = $this->getSchedule();
        $consumption['datasets'][0]['label'] = 'Pronóstico';
        $consumption['datasets'][1]['label'] = 'Real';
        return $consumption;
    }
}
