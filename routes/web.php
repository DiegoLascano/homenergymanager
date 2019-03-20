<?php

use App\Services\GeneticAlgorithm\Individual;
use App\Services\GeneticAlgorithm\Population;
use App\Services\GeneticAlgorithm\GeneticAlgorithm;
use App\Appliance;

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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/ga', function() {
    $appliances = Appliance::select('id')->where('status', '0')->get();
    $appliancesCount = count(Appliance::where('status', '0')->get());
    dd($appliances);
    return view('ga');
})->name('ga');

Route::resource('schedules', 'SchedulesController');
Route::resource('appliances', 'AppliancesController');