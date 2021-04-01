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

/**
 *  Modifies the dataset provided by ECDC (https://opendata.ecdc.europa.eu/covid19/casedistribution/json)
 *  Dataset will be in a much smaller state and will still contain the same information.
 *  ECDC's dataset does not contain daily information from before 01/03/2021 on some cases, 
 *  therefore there's a huge spike, this makes graphing the data daily at that date unhelpful for the enduser.
 */
Route::get('/data', function () {
    \Debugbar::disable();
   
    $daily = json_decode(file_get_contents('../storage/app/covid19_europe_daily.json'))->records;

    $data = [];
    foreach($daily as $x) {
        if (!in_array($x->geoId, $data)) {
            $data[$x->geoId] = [
                'name' => $x->countriesAndTerritories,
                'code' => $x->countryterritoryCode,
                'popData2020' => $x->popData2020,
                'total_cases' => 0,
                'total_deaths' => 0
            ];
        }
    }

    foreach($daily as $x) {
        // ECDC uses incontinence dateformats
        $date = DateTime::createFromFormat('d/m/Y', $x->dateRep)->format('Y-m-d');
  
        $data[$x->geoId]['data'][$date] = [
            'cases' => $x->cases,
            'deaths' => $x->deaths,
        ];

        // Update the totals
        $data[$x->geoId]['total_cases'] += $x->cases;
        $data[$x->geoId]['total_deaths'] += $x->deaths;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
});

      header('Content-Type: application/json');
      echo json_encode($newData);
      exit;
});

Route::get('/data/latest/total', function () {
    \Debugbar::disable();
   
    // $response = Http::get('https://opendata.ecdc.europa.eu/covid19/casedistribution/json');
    $data = json_decode(file_get_contents('../storage/app/covid_data.json'));
    $newData = [];

    $dates = [];
    foreach($data as $x) {
        if (in_array($x->year_week, $dates)) {
            break;
        }
        array_push($dates, $x->year_week);
    }

    $latest = end($dates);

    foreach($data as $x) {
        if(isset($x->country_code) && $x->year_week == $latest) {
            if($x->country_code == 'XKX') { // Kosovo appears to have a weird code
                $newData[$x->year_week]['XK'] = [
                    'country' => $x->country,
                    'weekly_count' => $x->weekly_count,
                    'cumulative' => $x->cumulative_count,
                ];
            } else {
                $isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
                $country = $isoCodes->getCountries()->getByAlpha3($x->country_code);
                $newData[$x->year_week][$country->getAlpha2()] = [
                    'country' => $x->country,
                    'weekly_count' => $x->weekly_count,
                    'cumulative' => $x->cumulative_count,
                ];
            }
        }     
      }

      arsort($newData); // Sort values according to value

      header('Content-Type: application/json');
      echo json_encode($newData[$latest]);
      exit;
});

// TODO: This needs to be adapted to work with any country
Route::get('/data/swe', function () {
    \Debugbar::disable();
   
    // $response = Http::get('https://opendata.ecdc.europa.eu/covid19/casedistribution/json');
    $data = json_decode(file_get_contents('../storage/app/covid_data.json'));
    $newData = [];
    $counties = [];
    $i = 0;
    foreach($data as $key => $x) {
        // List of all counties
        if(isset($x->country_code)) { 
            $counties['counties'][$x->country_code] = $x->country;
        }
        // Data for the specific country
        if(isset($x->country_code) && $x->country_code == "SWE") {
            $isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
            $country = $isoCodes->getCountries()->getByAlpha3($x->country_code);
            
            // Some info regarding the country
            if($i == 0) {
                $newData = [
                    "country" => $x->country,
                    "country_alpha2" => $country->getAlpha2(),
                    "country_code" => $x->country_code,
                    "continent" => $x->continent,
                    "population" => $x->population,
                    "indicator" => $x->indicator,
                    "source" => $x->source,
                ];
            }
            $i++;

            $date = explode("-",$x->year_week);
            // The actual data regarding the country
            $newData['data'][$x->year_week] = [
                "weekly" => $x->weekly_count,
                "cumulative" => $x->cumulative_count,
                "rate_14_day" => isset($x->rate_14_day) ? (float)$x->rate_14_day : 0,
                "start" => date( "Y-m-d", strtotime($date[0]."W".$date[1]."1") ),
                "end" => date( "Y-m-d", strtotime($date[0]."W".$date[1]."7") ),
                "indicator" => $x->indicator,
            ];
        }     
    }

    // Update the indicator, ECDC have a different one for the first ones it appears
    $newData['indicator'] = end($newData['data'])['indicator'];

    header('Content-Type: application/json');
    echo json_encode($newData+$counties);
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
