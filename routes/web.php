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
use App\Events\PvUpdated;
use App\Events\FlashMessage;
use App\Events\FlashMsg;
use App\Events\FlaMsg;

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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'TabsController@dashboard')->name('dashboard');
Route::get('/trends', 'TabsController@trends')->name('trends');
Route::get('/historical', 'TabsController@historical')->name('historical');
Route::get('/pvreal', function(){
    return view('pages.pvreal');
});

Route::get('/api/energyCost', 'FetchDataAPI@energyCost')->name('energyCost');
Route::get('/api/pvSim', 'FetchDataAPI@pvSim')->name('pvSim');
Route::get('/api/schedule', 'FetchDataAPI@schedule')->name('schedule');
Route::get('/api/realtimeData', 'FetchDataAPI@realtimeData')->name('realtimeData');

/**
 * Routes for small cards with daily values
 */
Route::get('/api/dailyAvg', 'FetchDataAPI@dailyAvg')->name('dailyAvg');
// Route::get('/api/historicalAvg', 'FetchDataAPI@historicalAvg')->name('historicalAvg');
Route::get('/api/estimatedCost', 'FetchDataAPI@estimatedCost')->name('estimatedCost');
Route::get('/api/realCost', 'FetchDataAPI@realCost')->name('realCost');
Route::get('/api/grossCost', 'FetchDataAPI@grossCost')->name('grossCost');
// Route::get('/api/historicalGrossCost', 'FetchDataAPI@historicalGrossCost')->name('historicalGrossCost');
Route::get('/api/consumedEnergy', 'FetchDataAPI@consumedEnergy')->name('consumedEnergy');
Route::get('/api/pvRealUsed', 'FetchDataAPI@pvRealUsed')->name('pvRealUsed');
Route::get('/api/pvSimUsed', 'FetchDataAPI@pvSimUsed')->name('pvSimUsed');

Route::get('/ga', function() {
    $title = 'success';
    $message = 'New schedule generated successfully';
    event(new FlashMessage($title, $message));
    return view('ga');
})->name('ga');
Route::get('/back', function () {
    session()->flash('error', 'Success message');
    session()->flash('type', 'error');
    return redirect()->back();
    // return redirect()->back()->with('message', 'Success message');
});

Route::get('ga/importData', function(){
    // IMPORT CSV FOR Prcu DATA
})->name('importData');

Route::resource('schedules', 'SchedulesController');
Route::resource('appliances', 'AppliancesController');
Route::resource('dailyPV', 'DailyPVController');

Route::get('/api/userControl', function() {
    $routes[0]['name'] = 'Dashboard';
    $routes[0]['route'] = 'http://homenergymanager.test/dashboard';
    $routes[1]['name'] = 'Appliances';
    $routes[1]['route'] = 'http://homenergymanager.test/appliances';
    $routes[2]['name'] = 'PV Control';
    $routes[2]['route'] = 'http://homenergymanager.test/dailyPV';
    $routes[3]['name'] = 'Schedules';
    $routes[3]['route'] = 'http://homenergymanager.test/schedules';

    return $routes;
});