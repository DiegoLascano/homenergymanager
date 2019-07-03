<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Prcu;
use App\PowerGenerated;
use App\Schedule;
use App\Appliance;
use App\DailyPV;
use App\Events\FlashMessage;

class FetchDataAPI extends Controller
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
    * Get today's schedule if exist
    *
    * @param Type $var var explanation
    */
    public function scheduleToday($date)
    {
        $chromosome = Schedule::whereDate('created_at', $date)->where('status', 'COMPLETED')->latest()->first()['chromosome'];
        if (is_null($chromosome)) {
            return null;
        };
        return $chromosome;
    }
    
    /**
    * Prepare energy cost data for the graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function energyCost()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $date1 = request('date1') ?: $today;

        if (request()->has('date2')) {
            $date2 = request('date2') ?: $yesterday;
        }

        $data[0] = Prcu::where('date', $date1)->get();
        if (isset($date2)) {
            $data[1] = Prcu::where('date', $date2)->get();
        }

        // $day1 = request('day1') ?: 1;
        // if (request()->has('day2')) {
        //     $day2 = request('day2') ?: 50;
        // }
        // $data[0] = Prcu::where('id', $day1)->get();
        // if (isset($day2)) {
        //     $data[1] = Prcu::where('id', $day2)->get();
        // }

        $costArray = [];
        $datasets = [];
        foreach ($data as $key => $prcu) {
            for ($i=1; $i < 25; $i++) { 
                $costArray[$i-1] = $prcu[0][$i];
            }
            $costArray[24] = $prcu[0][24];

            $dataDate = $prcu[0]['date'];
            $dataLabel = Carbon::parse($dataDate)->toFormattedDateString();
            $datasets[$key]['label'] = $dataLabel;
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
    public function pvSim()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $date1 = request('date1') ?: $today;

        if (request()->has('date2')) {
            $date2 = request('date2') ?: $yesterday;
        }

        $data[0] = PowerGenerated::where('date', $date1)->get();
        if (isset($date2)) {
            $data[1] = PowerGenerated::where('date', $date2)->get();
        }

        // dd($data);
        $pvArray = [];
        $datasets = [];
        foreach ($data as $key => $pvGen) {
            for ($i=1; $i < 25; $i++) { 
                $pvArray[$i-1] = $pvGen[0][$i];
            }
            $pvArray[24] = $pvGen[0][24];

            $dataDate = $pvGen[0]['date'];
            $dataLabel = Carbon::parse($dataDate)->toFormattedDateString();
            $datasets[$key]['label'] = $dataLabel;
            $datasets[$key]['data'] = collect($pvArray)->values();
        }

        $PVGenerated['labels'] = collect($pvArray)->keys();

        $PVGenerated['datasets'] = $datasets;

        return $PVGenerated;
    }

    /**
    * Prepare real PV Generated energy for the graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function pvGenReal()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $today = Carbon::today()->format('Y-m-d');
        $date1 = request('date1') ?: $today;

        if (request()->has('date2')) {
            $date2 = request('date2') ?: $yesterday;
        }

        $data[0] = DailyPV::where('date', $date1)->get();
        if (isset($date2)) {
            $data[1] = DailyPV::where('date', $date2)->get();
        }

        // dd($data);
        $pvArray = [];
        $datasets = [];
        foreach ($data as $key => $pvGenReal) {
            for ($i=1; $i < 25; $i++) { 
                $pvArray[$i-1] = $pvGenReal[0][$i];
            }
            $pvArray[24] = $pvGenReal[0][24];

            $dataDate = $pvGenReal[0]['date'];
            $dataLabel = Carbon::parse($dataDate)->toFormattedDateString();
            $datasets[$key]['label'] = $dataLabel;
            $datasets[$key]['data'] = collect($pvArray)->values();
        }

        $PVGenerated['labels'] = collect($pvArray)->keys();

        $PVGenerated['datasets'] = $datasets;

        return $PVGenerated;
    }



    
    /**
    * Get the PV energy generated for a day
    *
    */
    public function pvGA($date)
    {
        $energyPV = [];
        $m = 0;

        // if (is_null($date)) {
        //     $date = Carbon::now()->format('Y-m-d');
        // }
        $PV = PowerGenerated::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $date)->get();
                        
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
    * Get the PV energy generated REAL for today
    *
    */
    public function pvReal($date)
    {
        $realPvGenerated = [];
        $m = 0;
        // if (is_null($date)) {
        //     $date = Carbon::now()->format('Y-m-d');
        // }
        $PV = DailyPV::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $date)->get();
        // Generate a vector with 120 values 
        for ($i=1; $i < 25; $i++) { 
            $hourlyRealPV = $PV[0][$i];

            // PV energy for each timeslot
            for ($j=1; $j < 6; $j++) { 
                $realPvGenerated[$m] = $hourlyRealPV / 5;
                $m++;
            }
        }
        return $realPvGenerated;
    }

    /**
    * Get the cost of energy from DB for today Prcu
    *
    */
    public function energyCostGA($date)
    {
        $energyCost = [];
        $m = 0;
        // if (is_null($date)) {
        //     $date = Carbon::now()->format('Y-m-d');
        // }
        // dd($date);
        $costs = Prcu::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                        ->where('date', $date)->get();
                        
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
    // public function schedule()
    // {
    //     $chromosome = $this->scheduleToday();
    //     if (is_null($chromosome)) {
    //         return null;
    //     }
    //     $schedule = explode(",", $chromosome);

    //     $energyCost = $this->energyCostGA(); //get energy cost of today
    //     $energyPV = $this->pvGA(); //get pv generated (SAM data) of today

    //     $appliances = Appliance::where('owner_id', auth()->id())->where('status', '0')->get();
    //     $appliancesCount = count($appliances);

    //     $lastTimeslot = 120;
    //     $i = 0;
    //     $pscd = array_fill(0, $lastTimeslot, 0);

    //     $sumEnergia = array_fill(0, $lastTimeslot, 0);
    //     $sumEnergiaPV = array_fill(0, $lastTimeslot, 0);

    //     $hourlyPV = array_fill(0, 24, 0);
    //     $hourlyNoPV = array_fill(0, 24, 0);
    //     foreach ($appliances as $appliance) {
    //         $start = $schedule[$i];
    //         $la = $appliance->length_operation;
    //         $finish = $start + $la;
    //         $power = $appliance->power_kWh;

    //         $consumptionMatrix[$i] = array_fill(0, $lastTimeslot, 0);
    //         for ($j = $start; $j < $finish; $j++) { 
    //             $consumptionMatrix[$i][$j] = $power / ($lastTimeslot / 24);
    //         }
    //         $i++;
    //     }
        
    //     for ($m = 0; $m < $lastTimeslot; $m++) { 
    //         for ($n = 0; $n < $appliancesCount; $n++) { 
    //             $pscd[$m] =  $pscd[$m] + $consumptionMatrix[$n][$m];
    //         }
    //         $netPscd = $pscd[$m] - $energyPV[$m];
    //         if ($netPscd < 0) $netPscd = 0;
    //         $sumEnergiaPV[$m] = $netPscd * $energyCost[$m];
    //         $sumEnergia[$m] = $pscd[$m] * $energyCost[$m];
    //     }
    //     $hourlySumPV = 0;
    //     $hourlySumNoPV = 0;
    //     $j = 0;
    //     for ($i = 0; $i < $lastTimeslot; $i++) { 
    //         $hourlySumPV += $sumEnergiaPV[$i];
    //         $hourlySumNoPV += $sumEnergia[$i];
    //         // cada 5 timeslots totaliza la suma de 1 hora
    //         if ((($i+1) % 5) == 0) {
    //             $hourlyPV[$j] = $hourlySumPV;
    //             $hourlyNoPV[$j] = $hourlySumNoPV;
    //             $hourlySumPV = 0;
    //             $hourlySumNoPV = 0;
    //             $j++;
    //         }
    //     }
    //     $datasets[0]['label'] = 'PV';
    //     $datasets[0]['data'] = collect($hourlyPV)->values();
    //     $datasets[1]['label'] = 'No PV';
    //     $datasets[1]['data'] = collect($hourlyNoPV)->values();
    //     $consumption['labels'] = collect($hourlyPV)->keys();
    //     $consumption['datasets'] = $datasets;
    //     // dump(array_sum($sumEnergiaPV));
    //     // dump(array_sum($hourlyPV));
    //     // dump(array_sum($sumEnergia));
    //     // dd($hourlyPV);

    //     return $consumption;
    // }

    /**
    * Prepare energy cost data for the realtime graph
    *
    * @return collection $energyCost Variable that includes labels and datasets
    */
    public function realtimeData()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $chromosome = $this->scheduleToday($date);
        if (is_null($chromosome)) {
            event(new FlashMessage('error', 'No existe cronograma para esta fecha'));
            return null;
        }

        $schedule = explode(",", $chromosome);

        $energyCost = $this->energyCostGA($date); //get energy cost of today
        $energyPV = $this->pvGA($date); //get pv generated (SAM data) of today
        $realPvGenerated = $this->pvReal($date); //get pv generated (REAL data) of today

        $appliances = Appliance::where('owner_id', auth()->id())->where('status', '0')->get();
        $appliancesCount = count($appliances);

        $lastTimeslot = 120;
        $i = 0;
        $pscd = array_fill(0, $lastTimeslot, 0);

        $sumCostoPVReal = array_fill(0, $lastTimeslot, 0);
        $sumCostoPV = array_fill(0, $lastTimeslot, 0);
        $sumCosto = array_fill(0, $lastTimeslot, 0);

        $sumEnergiaPVReal = array_fill(0, $lastTimeslot, 0);
        $sumEnergiaPV = array_fill(0, $lastTimeslot, 0);
        $sumEnergia = array_fill(0, $lastTimeslot, 0);

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
            $sumEnergiaPV[$m] = $netPscd;
            $sumCostoPV[$m] = $netPscd * $energyCost[$m];
            
            $netPscdReal = $pscd[$m] - $realPvGenerated[$m];
            if ($netPscdReal < 0) $netPscdReal = 0;
            $sumEnergiaPVReal[$m] = $netPscdReal;
            $sumCostoPVReal[$m] = $netPscdReal * $energyCost[$m];

            $sumCosto[$m] = $pscd[$m] * $energyCost[$m];
            $sumEnergia[$m] = $pscd[$m];
        }
        $data['sumCostoPVReal'] = $sumCostoPVReal;
        $data['sumCostoPV'] = $sumCostoPV;
        $data['sumEnergiaPVReal'] = $sumEnergiaPVReal;
        $data['sumEnergiaPV'] = $sumEnergiaPV;

        $data['sumCosto'] = $sumCosto;
        $data['sumEnergia'] = $sumEnergia;

        return $data;
    }

    /**
    * Purpose of the function
    *
    * @param Type $var var explanation
    */
    public function realtimeCost()
    {
        $lastTimeslot = 120;
        $hourly = array_fill(0, 24, 0);
        $hourlyPVReal = array_fill(0, 24, 0);
        $hourlySum = 0;
        $hourlySumPVReal = 0;
        $j = 0;

        $data = $this->realtimeData();
        for ($i = 0; $i < $lastTimeslot; $i++) { 
            // $hourlySumPV += $data['sumCostoPV'][$i];
            $hourlySum += $data['sumCosto'][$i];
            $hourlySumPVReal += $data['sumCostoPVReal'][$i];
            // cada 5 timeslots totaliza la suma de 1 hora
            if ((($i+1) % 5) == 0) {
                $hourly[$j] = $hourlySum;
                $hourlyPVReal[$j] = $hourlySumPVReal;
                $hourlySum = 0;
                $hourlySumPVReal = 0;
                $j++;
            }
        }
        $datasets[0]['label'] = 'Sin energía PV';
        $datasets[0]['data'] = collect($hourly)->values();
        $datasets[1]['label'] = 'Con energía PV';
        $datasets[1]['data'] = collect($hourlyPVReal)->values();
        $consumption['labels'] = collect($hourly)->keys();
        $consumption['datasets'] = $datasets;

        return $consumption;
    }
    
    /**
    * Purpose of the function
    *
    * @param Type $var var explanation
    */
    public function realtimeEnergy()
    {
        $lastTimeslot = 120;
        $hourly = array_fill(0, 24, 0);
        $hourlyPVReal = array_fill(0, 24, 0);
        $hourlySum = 0;
        $hourlySumPVReal = 0;
        $j = 0;

        $data = $this->realtimeData();
        for ($i = 0; $i < $lastTimeslot; $i++) { 
            $hourlySum += $data['sumEnergia'][$i];
            $hourlySumPVReal += $data['sumEnergiaPVReal'][$i];
            // cada 5 timeslots totaliza la suma de 1 hora
            if ((($i+1) % 5) == 0) {
                $hourly[$j] = $hourlySum;
                $hourlyPVReal[$j] = $hourlySumPVReal;
                $hourlySum = 0;
                $hourlySumPVReal = 0;
                $j++;
            }
        }
        $datasets[0]['label'] = 'Sin energía PV';
        $datasets[0]['data'] = collect($hourly)->values();
        $datasets[1]['label'] = 'Con energía PV';
        $datasets[1]['data'] = collect($hourlyPVReal)->values();
        $consumption['labels'] = collect($hourly)->keys();
        $consumption['datasets'] = $datasets;

        return $consumption;
    }

    /**
    * Calculate all the data for a given day
    *
    * @param Type $var var explanation
    */
    public function calculateDailyData($energyCost, $energyPV, $realPvGenerated, $appliances, $schedule)
    {
        $appliancesCount = count($appliances);

        $lastTimeslot = 120;
        $i = 0;
        $pscd = array_fill(0, $lastTimeslot, 0);
        $pscdPVSim = array_fill(0, $lastTimeslot, 0);
        $pscdPVReal = array_fill(0, $lastTimeslot, 0);

        $sumEnergiaPVReal = array_fill(0, $lastTimeslot, 0);
        $sumConsumo = array_fill(0, $lastTimeslot, 0);
        $sumEnergiaPV = array_fill(0, $lastTimeslot, 0);

        $excedentePvSim = array_fill(0, $lastTimeslot, 0);
        $excedentePvReal = array_fill(0, $lastTimeslot, 0);
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
                $pscd[$m] =  $pscd[$m] + $consumptionMatrix[$n][$m]; // vector [1x120] con la energia electrica de cada timeslot sumada
            }
            $sumConsumo[$m] = $pscd[$m] * $energyCost[$m]; // costo bruto generado por las cargas
            
            
            $netPscd = $pscd[$m] - $energyPV[$m];
            if ($netPscd < 0) {
                $excedentePvSim[$m] = (-$netPscd);
                $netPscd = 0;
            }
            $pscdPVSim[$m] = $netPscd; // vector energia consumida por las cargas - PV SAM
            $sumEnergiaPV[$m] = $netPscd * $energyCost[$m];
            
            $netPscdReal = $pscd[$m] - $realPvGenerated[$m];
            if ($netPscdReal < 0) {
                $excedentePvReal[$m] = (-$netPscdReal); 
                $netPscdReal = 0;
            }
            $pscdPVReal[$m] = $netPscdReal; // vector energia consumida por las cargas - PV real
            $sumEnergiaPVReal[$m] = $netPscdReal * $energyCost[$m];
            // $sumEnergia[$m] = $pscd[$m] * $energyCost[$m];
        }
        // dump(array_sum($pscd)); // Consumo electrico de cargas
        // dump(array_sum($pscdPVSim)); // Consumo electrico de cargas con PV SAM
        // dump(array_sum($pscdPVReal)); // Consumo electrico de cargas con PV real
        // dump($sumEnergiaPV); // Costo del consumo electrico de cargas con PV SAM
        // dump($sumEnergiaPVReal); // Costo del consumo electrico de cargas con PV real
        // dd($sumConsumo); // Costo del consumo electrico de cargas

        $data['pscd'] = $pscd;
        $data['pscdPVSim'] = $pscdPVSim;
        $data['pscdPVReal'] = $pscdPVReal;
        $data['costoBruto'] = $sumConsumo;
        $data['costoPvSim'] = $sumEnergiaPV;
        $data['costoPvReal'] = $sumEnergiaPVReal;

        $data['pvReal'] = $realPvGenerated;
        $data['pvExcedenteReal'] = $excedentePvReal;
        $data['pvEstimada'] = $energyPV;
        $data['pvExcedenteSim'] = $excedentePvSim;

        // dd($data);
        return $data;
    }

    /**
    * Purpose of the function
    *
    * @param Type $var var explanation
    */
    public function calculateDailyAvg($dailyData)
    {
        // $dailyAvg['pscd'] = array_sum($pscd);
        // $dailyAvg['pscdPVSim'] = array_sum($pscdPVSim);
        // $dailyAvg['pscdPVReal'] = array_sum($pscdPVReal);
        // $dailyAvg['costoBruto'] = array_sum($sumConsumo);
        // $dailyAvg['costoPvSim'] = array_sum($sumEnergiaPV);
        // $dailyAvg['costoPvReal'] = array_sum($sumEnergiaPVReal);
        // $dailyAvg['pvReal'] = array_sum($realPvGenerated);
        // $dailyAvg['pvExcedenteReal'] = $excedentePvReal;
        // $dailyAvg['pvEstimada'] = array_sum($energyPV);
        // $dailyAvg['pvExcedenteSim'] = $excedentePvSim;
        $dailyAvg['pscd'] = array_sum($dailyData['pscd']);
        $dailyAvg['pscdPVSim'] = array_sum($dailyData['pscdPVSim']);
        $dailyAvg['pscdPVReal'] = array_sum($dailyData['pscdPVReal']);
        $dailyAvg['costoBruto'] = array_sum($dailyData['costoBruto']);
        $dailyAvg['costoPvSim'] = array_sum($dailyData['costoPvSim']);
        $dailyAvg['costoPvReal'] = array_sum($dailyData['costoPvReal']);
        $dailyAvg['pvReal'] = array_sum($dailyData['pvReal']);
        $dailyAvg['pvExcedenteReal'] = array_sum($dailyData['pvExcedenteReal']);
        $dailyAvg['pvEstimada'] = array_sum($dailyData['pvEstimada']);
        $dailyAvg['pvExcedenteSim'] = array_sum($dailyData['pvExcedenteSim']);

        return $dailyAvg;
    }

    /**
    * Generate daily average values to show in cards
    *
    * @param Type $var var explanation
    */
    public function dailyAvg($date)
    {
        // $today = '2019-05-24';
        // $chromosome = Schedule::latest()->first()['chromosome']; // Aqui se debe seleccionar el Schedule para Carbon::now()
        $chromosome = $this->scheduleToday($date);
        if (is_null($chromosome)) {
            // event(new FlashMessage('error', 'No schedule generated for this date'));
            return null;
        }
        $schedule = explode(",", $chromosome);
        // dd($schedule);
        $energyCost = $this->energyCostGA($date); //get energy cost of today
        $energyPV = $this->pvGA($date); //get pv generated (SAM data) of today
        $realPvGenerated = $this->pvReal($date); //get pv generated (REAL data) of today

        $appliances = Appliance::where('owner_id', auth()->id())->where('status', '0')->get();
        // $appliancesCount = count($appliances);

        $dailyData = $this->calculateDailyData($energyCost, $energyPV, $realPvGenerated, $appliances, $schedule);
        $todaySummary = $this->calculateDailyAvg($dailyData);

        return $todaySummary;
    }

    /**
    * Generate daily array values for the graphics
    *
    * @param Type $var var explanation
    */
    public function dailyData($date)
    {
        $chromosome = $this->scheduleToday($date);
        if (is_null($chromosome)) {
            // event(new FlashMessage('error', 'No schedule generated for this date'));
            return null;
        }
        $schedule = explode(",", $chromosome);
        // dd($schedule);
        $energyCost = $this->energyCostGA($date); //get energy cost of today
        $energyPV = $this->pvGA($date); //get pv generated (SAM data) of today
        $realPvGenerated = $this->pvReal($date); //get pv generated (REAL data) of today

        $appliances = Appliance::where('owner_id', auth()->id())->where('status', '0')->get();

        $dailyData = $this->calculateDailyData($energyCost, $energyPV, $realPvGenerated, $appliances, $schedule);
        // dd($dailyData);
        return $dailyData;
    }

    /**
    * Fetch real cost array values for a given day for the graphics
    *
    * @param Type $var var explanation
    */
    public function realCostData()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $date = request('date') ?: $yesterday;
        $dailyData = $this->dailyData($date);
        // dd($dailyData);
        // $costArray = [];
        $datasets = [];
        $hourlyCost = array_fill(0, 24, 0);
        // $hourlyPVReal = array_fill(0, 24, 0);

        if (is_null($dailyData)) {
            event(new FlashMessage('error', 'No existe cronograma para esta fecha'));
            return null;
        }
        $data[0] = $dailyData['costoPvReal'];
        $data[1] = $dailyData['costoBruto'];
        // dd($data);
        foreach ($data as $key => $costSlot) {
            // dd($costSlot[2]);
            $hourlySum = 0;
            // $hourlySumPVReal = 0;
            $j = 0;
            for ($i = 0; $i < sizeof($costSlot); $i++) { 
                $hourlySum += $costSlot[$i];
                // $hourlySumPVReal += $sumEnergiaPVReal[$i];
                // cada 5 timeslots totaliza la suma de 1 hora
                if ((($i+1) % 5) == 0) {
                    $hourlyCost[$j] = $hourlySum;
                    // $hourlyPVReal[$j] = $hourlySumPVReal;
                    $hourlySum = 0;
                    // $hourlySumPVReal = 0;
                    $j++;
                }
            }
            // dd($costArray);
            $datasets[$key]['data'] = collect($hourlyCost)->values();
        }
        $datasets[0]['label'] = 'Con energía PV';
        $datasets[1]['label'] = 'Sin energía PV';
        
        $dayCost['labels'] = collect($hourlyCost)->keys();
        $dayCost['datasets'] = $datasets;
        // dd($dayCost);

        return $dayCost;
    }

    /**
    * Fetch energy array values for a given day for the graphics
    *
    * @param Type $var var explanation
    */
    public function energyData()
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $date = request('date') ?: $yesterday;
        $dailyData = $this->dailyData($date);
        // dd($dailyData);
        // $costArray = [];
        $datasets = [];
        $hourlyCost = array_fill(0, 24, 0);
        // $hourlyPVReal = array_fill(0, 24, 0);

        if (is_null($dailyData)) {
            event(new FlashMessage('error', 'No existe cronograma para esta fecha'));
            return null;
        }
        $data[0] = $dailyData['pscd'];
        $data[1] = $dailyData['pscdPVReal'];
        // dd($data);
        foreach ($data as $key => $costSlot) {
            // dd($costSlot[2]);
            $hourlySum = 0;
            // $hourlySumPVReal = 0;
            $j = 0;
            for ($i = 0; $i < sizeof($costSlot); $i++) { 
                $hourlySum += $costSlot[$i];
                // $hourlySumPVReal += $sumEnergiaPVReal[$i];
                // cada 5 timeslots totaliza la suma de 1 hora
                if ((($i+1) % 5) == 0) {
                    $hourlyCost[$j] = $hourlySum;
                    // $hourlyPVReal[$j] = $hourlySumPVReal;
                    $hourlySum = 0;
                    // $hourlySumPVReal = 0;
                    $j++;
                }
            }
            // dd($costArray);
            $datasets[$key]['data'] = collect($hourlyCost)->values();
        }
        $datasets[0]['label'] = 'Sin energía PV';
        $datasets[1]['label'] = 'Con energía PV';
        
        $dayEnergy['labels'] = collect($hourlyCost)->keys();
        $dayEnergy['datasets'] = $datasets;
        // dd($dayEnergy);

        return $dayEnergy;
    }

    /**
    * Generate daily gross cost of energy to show in card 
    *
    * @param Type $var var explanation
    */
    public function grossCost()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $dailyGrossCost['title'] = 'Costo diario (sin PV)';
        $dailyGrossCost['value'] = $summary['costoBruto'];
        
        if ($summary['costoBruto'] < 100) {
            $dailyGrossCost['unit'] = '¢';
        }else{
            $dailyGrossCost['value'] = $dailyGrossCost['value'] / 100;
            $dailyGrossCost['unit'] = '€';
        }

        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = (($summary['costoBruto']/$secondSummary['costoBruto'])-1)*100;
        $dailyGrossCost['badgeValue'] = $badgeValue;
        
        return $dailyGrossCost;      
    }

    /**
    * Generate daily cost of energy to show in card 
    *
    * @param Type $var var explanation
    */
    public function realCost()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $dailyRealCost['title'] = 'Costo real (con PV)';
        $dailyRealCost['value'] = $summary['costoPvReal'];
        
        if ($summary['costoPvReal'] < 100) {
            $dailyRealCost['unit'] = '¢';
        }else{
            $dailyRealCost['value'] = $dailyRealCost['value'] / 100;
            $dailyRealCost['unit'] = '€';
        }

        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = (($summary['costoPvReal']/$secondSummary['costoPvReal'])-1)*100;
        $dailyRealCost['badgeValue'] = $badgeValue;
        
        return $dailyRealCost;      
    }

    /**
    * Generate daily cost of energy to show in card 
    *
    * @param Type $var var explanation
    */
    public function estimatedCost()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $dailySimCost['title'] = 'Costo de la energía (sim)';
        $dailySimCost['value'] = $summary['costoPvSim'];
        
        if ($summary['costoPvSim'] < 100) {
            $dailySimCost['unit'] = '¢';
        }else{
            $dailySimCost['value'] = $dailySimCost['value'] / 100;
            $dailySimCost['unit'] = '€';
        }
        
        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = (($summary['costoPvSim']/$secondSummary['costoPvSim'])-1)*100;
        $dailySimCost['badgeValue'] = $badgeValue;

        return $dailySimCost;      
    }

    /**
    * Generate daily energy consumption to show in card 
    *
    * @param Type $var var explanation
    */
    public function consumedEnergy()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $dailyConsumedEnergy['title'] = 'Energía consumida';
        $dailyConsumedEnergy['value'] = $summary['pscd'];

        $dailyConsumedEnergy['unit'] = 'kWh';

        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = (($summary['pscd']/$secondSummary['pscd'])-1)*100;
        $dailyConsumedEnergy['badgeValue'] = $badgeValue;
        
        return $dailyConsumedEnergy;      
    }

    /**
    * Generate daily simulated PV energy used to show in card 
    *
    * @param Type $var var explanation
    */
    public function pvSimUsed()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $dailyPvSimUsed['title'] = 'Energía PV usada (sim)';
        $dailyPvSimUsed['value'] = $summary['pvEstimada'] - $summary['pvExcedenteSim'];

        $dailyPvSimUsed['unit'] = 'kWh';
        
        return $dailyPvSimUsed;      
    }

    /**
    * Generate daily real PV energy used to show in card 
    *
    * @param Type $var var explanation
    */
    public function pvRealGenerated()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);
        $realPvGenerated['title'] = 'Generación PV real';
        $realPvGenerated['value'] = $summary['pvReal'];

        $realPvGenerated['unit'] = 'kWh';
        
        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = ((($summary['pvReal'])/($secondSummary['pvReal']))-1)*100;
        $realPvGenerated['badgeValue'] = $badgeValue;

        return $realPvGenerated;      
    }

    /**
    * Calculate the cost of energy daily savings (real - estimated cost)
    *
    * @param Type $var var explanation
    */
    public function costSavings()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);

        $dailySavings['title'] = 'Ahorro';
        $dailySavings['value'] = $summary['costoBruto'] - $summary['costoPvReal'];

        if ($dailySavings['value'] < 100) {
            $dailySavings['unit'] = '¢';
        }else{
            $dailySavings['value'] = $dailySavings['value'] / 100;
            $dailySavings['unit'] = '€';
        }
        
        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = ((($summary['costoBruto'] - $summary['costoPvReal'])/$summary['costoBruto']))*100;
        // $badgeValue = ((($summary['costoBruto'] - $summary['costoPvReal'])/($secondSummary['costoBruto'] - $secondSummary['costoPvReal']))-1)*100;
        $dailySavings['badgeValue'] = $badgeValue;
        // dd($dailySavings);

        return $dailySavings;
    }
    
    /**
    * Calculate the energy daily savings (energy consumed - pv energy used)
    *
    * @param Type $var var explanation
    */
    public function energySavings()
    {
        $today = Carbon::now()->format('Y-m-d');
        $date = request('date') ?: $today;
        $summary = $this->dailyAvg($date);

        $energySavings['title'] = 'Ahorro de energía';
        $energySavings['value'] = $summary['pvReal'] - $summary['pvExcedenteReal'];
        $energySavings['unit'] = 'kWh';
        // if ($energySavings['value'] >= 1) {
        //     $energySavings['unit'] = 'kWh';
        // }else{
        //     $energySavings['value'] = $energySavings['value'] * 100;
        //     $energySavings['unit'] = 'Wh';
        // }
        
        $secondDate = Carbon::parse($date)->subDays(1)->format('Y-m-d');
        // $secondSummary = $this->dailyAvg($secondDate);
        $badgeValue = ((($summary['pvReal'] - $summary['pvExcedenteReal'])/$summary['pscd']))*100;
        // $badgeValue = ((($summary['pvReal'] - $summary['pvExcedenteReal'])/($secondSummary['pvReal'] - $secondSummary['pvExcedenteReal']))-1)*100;
        $energySavings['badgeValue'] = $badgeValue;
        // dd($energySavings);

        return $energySavings;
    }

}
