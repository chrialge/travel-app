<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Step;

class ShowStepController extends Controller
{
    public function show(Step $step)
    {
        return view('steps.show', compact('step'));
    }
}
