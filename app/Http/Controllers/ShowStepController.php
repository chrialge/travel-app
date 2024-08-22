<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;

class ShowStepController extends Controller
{
    public function show(Step $step)
    {
        // renderizza alla pagina show degl'itinerari e passa gl'itinearari
        return view('steps.show', compact('step'));
    }
}
