<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ShowStepController extends Controller
{
    public function show(Step $step)
    {


        $dd = Http::get('https://api.tomtom.com/style/1/sprite/20.3.2-3/sprite@2x.png?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd&traffic_incidents=incidents_s1&traffic_flow=flow_relative0-dark');
        // dd($response);

        $client = new Client();
        $address = urlencode($step->location);
        $response = $client->get('https://api.tomtom.com/search/2/geocode/%27.' . $address . '.%27.json', [
            'query' => [
                'key' => 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd',
                'limit' => 1
            ]
        ]);
        error_log(print_r($response, true));
        // dd($response->getBody(), $response);
        $data = json_decode($response->getBody(), true);
        // dd($data);
        $latitude = $data['results'][0]['position']['lat'];
        $longitude = $data['results'][0]['position']['lon'];
        $pos = $longitude . ',' . $latitude;


        // dd($latitude, $longitude);
        // $gesu = Http::withUrlParameters([
        //     'baseURL' => 'api.tomtom.com',
        //     'versionNumber' => 1,
        //     'Your_API_Key' => 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd',
        //     'longitude' => $longitude,
        //     'latitude' => $latitude,
        //     'format' => 'png',
        //     'layer' => 'basic',
        //     'style' => 'main',
        //     'width' => 512,
        //     'height' => 512,
        //     'geopoliticalView' => 'Unified',
        //     'language' => 'it-IT'
        // ])->get("https://{baseURL}/map/{versionNumber}/staticimage?key={Your_API_Key}&zoom=9&center={longitude},{latitude}&format={format}&layer={layer}&style={style}&width={width}&height={height}&view={geopoliticalView}&language={language}");


        // renderizza alla pagina show degl'itinerari e passa gl'itinearari
        return view('steps.show', compact('step', 'latitude', 'longitude'));
    }
}
