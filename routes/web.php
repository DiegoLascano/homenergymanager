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
use App\PowerGenerated;

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

Route::get('/dashboard', 'TabsController@dashboard')->name('dashboard');
Route::get('/graphs', 'TabsController@graphs')->name('graphs');

Route::get('/api/getEnergyCost', 'grabData@getEnergyCost')->name('getEnergyCost');
Route::get('/api/getPV', 'grabData@getPV')->name('getPV');
Route::get('/api/getSchedule', 'grabData@getSchedule')->name('getSchedule');

Route::get('/ga', function() {
    /* $energyPV = [];
    $m = 0;
    $day = Carbon::now()->format('Y-m-d');
    $PV = PowerGenerated::select('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24')
                    ->where('date', $day)->get();
                    
    // Generate a vector with 120 values 
    for ($i=1; $i < 25; $i++) { 
        $hourlyPV = $PV[0][$i];
        for ($j=1; $j < 6; $j++) { 
            $energyPV[$m] = $hourlyPV;
            $m++;
        }
    }
    dd($energyPV); */
    return view('ga');
})->name('ga');

Route::get('ga/importData', function(){
    // IMPORT CSV FOR Prcu DATA
})->name('importData');

Route::resource('schedules', 'SchedulesController');
Route::resource('appliances', 'AppliancesController');