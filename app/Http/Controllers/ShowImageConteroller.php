<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShowImageConteroller extends Controller
{
    public function showImage()
    {
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
        return response()->file($gesu['data']);
    }
}
