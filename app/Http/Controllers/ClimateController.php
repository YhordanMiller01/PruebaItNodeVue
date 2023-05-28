<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Climate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ClimateController extends Controller
{
    public function __construct() {
        $this->key = $_ENV['APPI_KEY_OPEN_WEATHER'];;
    }

    /**
     * search function
     *
     * @param [type] $city
     * @return void
     */
    public function search($city) {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID='.$this->key);
        return json_decode($response,true);
    }

    /**
     * getDateClimate function
     *
     * @param [type] $city
     * @return void
     */
    public function getDateClimate($city) {
        return Http::get('https://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID='.$this->key);
    }

    /**
     * saveClimate function
     *
     * @param Request $request
     * @return void
     */
    public function saveClimate(Request $request) {
        $data_clima =  json_decode($this->getDateClimate($request->city)->getBody(),true);
        $climate = new Climate;
        $climate->user_id = $request->id;
        $climate->date = Carbon::now();
        $climate->lon = $data_clima['coord']['lon'];
        $climate->lat = $data_clima['coord']['lat'];
        $climate->temp = $data_clima['main']['temp'];
        $climate->feels_like = $data_clima['main']['feels_like'];
        $climate->temp_min = $data_clima['main']['temp_min'];
        $climate->temp_max = $data_clima['main']['temp_max'];
        $climate->pressure = $data_clima['main']['pressure'];
        $climate->humidity = $data_clima['main']['humidity'];
        $climate->speed = $data_clima['wind']['speed'];
        $climate->deg = $data_clima['wind']['deg'];
        $climate->save();

        return response()->json($climate);
    }

    /**
     * historialClimate function
     *
     * @return void
     */
    public function historialClimate() {
        $data = Climate::with(['user'])->get();
        //dd($data);

        return view ( 'historial' )->withData ( $data );
    }


}
