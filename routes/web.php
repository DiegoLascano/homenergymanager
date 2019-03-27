<?php

use App\Services\GeneticAlgorithm\Individual;
use App\Services\GeneticAlgorithm\Population;
use App\Services\GeneticAlgorithm\GeneticAlgorithm;
use App\Appliance;
use Carbon\Carbon;
use App\Services\GeneticAlgorithm\Schedule;
use App\Prcu;
use App\Services\GeneticAlgorithm\SchedulingGA;
use App\Services\GeneticAlgorithm\FitnessFunction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/prueba', function () {
    return view('tw_layout');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/api/getEnergyCost', 'grabData@getEnergyCost')->name('getEnergyCost');

Route::get('/ga', function() {

    $today = Carbon::today()->format('Y-m-d');
    $data = Prcu::where('date', $today)->get();

    // dd($data[0]['date']);
    $costArray = [];
    for ($i=1; $i < 25; $i++) { 
        $costArray[$i-1] = $data[0][$i];
    }

    foreach ($costArray as $key => $value) {
        $energyCost['datasets'][$key] = $value;
    }
    // $energyCost['labels'] = collect($costArray)->keys();

    dd($energyCost);

    // $individual = Individual::random(16);
    // dump($individual->getChromosome()[4]);
    // dd($individual->getChromosome());

    // dd($consumptionMatrix);
    // $timeSlots = 120;
    // $schedule = new Schedule($timeSlots);

    // $appliances = Appliance::where('status', '0')->get();
    // $schedule->setAppliances($appliances);
    
    // $appliancesCount = count($appliances);
    // $schedule->setAppliancesCount($appliancesCount);

    // $energyCost = [];
    // $m = 0;
    // $day = Carbon::now()->format('Y-m-d');
    // $costs = Prcu::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
    // ->where('date', $day)->get();
    
    // // Generate a vector with 120 values 
    // for ($i=1; $i < 25; $i++) { 
    //     $hourlyCost = $costs[0][$i];
    //     for ($j=1; $j < 6; $j++) { 
    //         $energyCost[$m] = $hourlyCost;
    //         $m++;
    //     }
    // }
    // $schedule->setEnergyCost($energyCost);
    // $pscd = array_fill(0, $schedule->getTimeslots(), 0);
    // dd($schedule->getEnergyCost());
    return view('ga');
})->name('ga');

Route::get('ga/importData', function(){
    // IMPORT CSV FOR Prcu DATA
})->name('importData');

Route::resource('schedules', 'SchedulesController');
Route::resource('appliances', 'AppliancesController');