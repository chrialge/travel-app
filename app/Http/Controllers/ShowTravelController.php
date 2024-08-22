<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Models\Vote;

class ShowTravelController extends Controller
{
    public function show(Travel $travel)
    {
        // salvo in una variabile gl'itinerari del viaggio
        $steps = Step::where('travel_id', $travel->id)->orderByDesc('date')->get();

        // renderizza alla pagina show del viaggio e passa il viaggio con i suoi itinerari
        return view('travel.show', compact('travel', 'steps'));
    }
}
