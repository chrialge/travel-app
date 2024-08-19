<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Vote;
use Illuminate\Http\Request;


class VoteController extends Controller
{
    public function addVote(Step $step, Request $request)
    {
        // dd($step, $request->input('vote'));

        $val_data['step_id'] = $step->id;
        $val_data['vote'] = $request->input('vote');

        $vote = Vote::create($val_data);
        return redirect()->back()->with('message', "Grazie per aver dato un voto al itinerario: $step->name");
    }
}
