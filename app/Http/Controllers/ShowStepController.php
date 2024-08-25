<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ShowStepController extends Controller
{
    public function show(Step $step)
    {


        $response = Http::get('https://api.tomtom.com/style/1/sprite/20.3.2-3/sprite@2x.png?key=k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd&traffic_incidents=incidents_s1&traffic_flow=flow_relative0-dark');
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
        $data = json_decode($response->getBody(), true);
        $latitude = $data['results'][0]['position']['lat'];
        $longitude = $data['results'][0]['position']['lon'];


        $gesu = Http::withUrlParameters([
            'baseURL' => 'api.tomtom.com',
            'versionNumber' => 1,
            'layer' => 'basic',
            'style' => 'main',
            'zoom' => 4,
            'X' => 8,
            'Y' => 5,
            'format' => 'png',
            'Your_API_Key' => 'k41eUXpkTG7gxEctBAJDidKJ6MYAEIwd',
            'tileSize' => 512,
            'geopoliticalView' => 'Unified',
            'language' => 'it-IT'
        ])->get("https://{baseURL}/map/{versionNumber}/tile/{layer}/{style}/{zoom}/{X}/{Y}.{format}?key={Your_API_Key}&tileSize={tileSize}&view={geopoliticalView}&language={language}");
        $data = $gesu->getBody();
        dd($data);

        // $madonna = Http::get('https://{baseURL}/map/{versionNumber}/tile/{layer}/{style}/{zoom}/{X}/{Y}.{format}?key={Your_}');
        // dd($gesu);
        // dd($latitude, $longitude, $step->location);

        // dd($response);
        // renderizza alla pagina show degl'itinerari e passa gl'itinearari
        return view('steps.show', compact('step', 'latitude', 'longitude'));
    }
}
