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
        $steps = Step::where('travel_id', $travel->id)->orderByDesc('date')->get();
        $rate = Vote::avg('vote');
        return view('front.show', compact('travel', 'steps', 'rate'));
    }
}
