<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/data', function () {
    \Debugbar::disable();
   
    // $response = Http::get('https://opendata.ecdc.europa.eu/covid19/casedistribution/json');
    $data = json_decode(file_get_contents('../storage/app/covid_data.json'));
    $newData = [];
    foreach($data as $x) {
        // TODO: This needs to be handled better for prod.
        if(isset($x->country_code) && $x->year_week == "2021-10") {
            if($x->country_code == 'XKX') { // Kosovo appears to have a weird code
                $newData['XK'] = $x->cumulative_count;
            } else {
                $isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
                $country = $isoCodes->getCountries()->getByAlpha3($x->country_code);
                $newData[$country->getAlpha2()] = $x->cumulative_count;
            }
        }     
      }

      arsort($newData); // Sort values according to value

      header('Content-Type: application/json');
      echo json_encode($newData);
      exit;
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz', function () {
    return view('quiz');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
