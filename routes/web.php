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

Route::get('/update', function () {
    if (App::environment('local')) {
        \Debugbar::disable();
    } 
   
    file_put_contents("../storage/app/covid19_europe_daily.json", fopen("https://opendata.ecdc.europa.eu/covid19/nationalcasedeath_eueea_daily_ei/json/", 'r'));
    file_put_contents("../storage/app/hospitalicuadmissionrates.json", fopen("https://opendata.ecdc.europa.eu/covid19/hospitalicuadmissionrates/json/", 'r'));
    echo "All datasets have been updated!";
    exit;
});

/**
 *  Modifies the dataset provided by ECDC (https://opendata.ecdc.europa.eu/covid19/)
 *  Dataset will be in a much smaller state and will still contain the same information.
 *  ECDC's dataset does not contain daily information from before 01/03/2021 on some cases, 
 *  therefore there's a huge spike, this makes graphing the data daily at that date unhelpful for the enduser.
 */
Route::get('/data/{country?}', function ($country = null) {
    if (App::environment('local')) {
        \Debugbar::disable();
    } 
    
    $data = [];
    // Datasets from ECDC
    $daily = json_decode(file_get_contents('../storage/app/covid19_europe_daily.json'))->records;
    $icu = json_decode(file_get_contents('../storage/app/hospitalicuadmissionrates.json'));

    // Country information
    foreach($daily as $x) {
        if (!in_array($x->geoId, $data)) {
            $data[$x->countriesAndTerritories] = [
                'country' => $x->countriesAndTerritories,
                'geoId' => $x->geoId,
                'code' => $x->countryterritoryCode,
                'popData2020' => $x->popData2020,

                // Placeholder data for totals
                'totalCases' => 0,
                'totalDeaths' => 0
            ];
        }
    }

    // Add the ICU sources to the country info
    foreach($icu as $x) {
        if(isset($x->date)) {
            $data[$x->country]['icu'] = [
                'source' => $x->source,
                'url' => $x->url,
            ];
        }
    }

    // Store all data on ICU
    $icuData = [];
    foreach($icu as $x) {
        if(isset($x->date)) {
            $icuData[$x->country][$x->date] = $x->value;
        }
    }

    // Process the daily data and ICU data into the same dataset
    foreach($daily as $x) {
        // ECDC uses incontinence dateformats
        $date = DateTime::createFromFormat('d/m/Y', $x->dateRep)->format('Y-m-d');
  
        $data[$x->countriesAndTerritories]['daily'][$date] = [
            'cases' => $x->cases,
            'deaths' => $x->deaths,
            // ICU reporting will only show for dates where we have daily cases.
            'icu' => isset($icuData[$x->countriesAndTerritories][$date]) ? $icuData[$x->countriesAndTerritories][$date] : null,
        ];

        // Update the totals
        $data[$x->countriesAndTerritories]['totalCases'] += $x->cases;
        $data[$x->countriesAndTerritories]['totalDeaths'] += $x->deaths;

    }

    // Sort the data based on total reported cases
    uasort($data, function ($x, $y) {
        return $y['totalCases'] - $x['totalCases'];
    });

    // Processes the output whether or not we show one or all countries
    if(isset($data[ucfirst($country)])) {
        return response()->json($data[ucfirst($country)]);
    } else {
        return response()->json($data);
    }
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vue', function () {
    return view('vue');
});

Route::get('/vue/timeline', function () {
    return view('vue_timeline');
});

Route::get('/vue/geochart', function () {
    return view('vue_geochart');
});

Route::get('/vue/barchart', function () {
    return view('vue_barchart');
});

Route::get('/react', function () {
    return view('react');
});

Route::get('/react/geochart', function () {
    return view('react_geochart');
});

Route::get('/react/barchart', function () {
    return view('react_barchart');
});

Route::get('/userstudy', function () {
    return view('userstudy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
