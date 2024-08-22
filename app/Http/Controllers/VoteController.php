<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Vote;
use Illuminate\Http\Request;


class VoteController extends Controller
{
    public function addVote(Step $step, Request $request)
    {
        // salvo nella chiave step_id l'id dello step
        $val_data['step_id'] = $step->id;

        // salvo nella chiave vote il voto passato
        $val_data['vote'] = $request->input('vote');

        // salvo nella variabile il voto creato
        $vote = Vote::create($val_data);

        // renderizzo alla pagina precedente con un messaggio di session 
        return redirect()->back()->with('message', "Grazie per aver dato un voto di $vote->vote al itinerario: $step->name");
    }
}
