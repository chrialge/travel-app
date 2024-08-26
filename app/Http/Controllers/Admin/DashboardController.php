<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Step;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        // variabile che salva l'id dell'utente che si e loggato
        $id = Auth::id();
        //salva in una variabile i viaggi in base all'id dell'utente attualmente collegato
        $travels = Travel::where('user_id', $id)->get();

        // creo una variabile con un array vuoto
        $range = [];

        // itero i viaggi
        foreach ($travels as $travel) {

            // pusho tutti gli id dei viaggi in range
            array_push($range, $travel->id);
        }

        //salva in una variabile i viaggi in base all'id dell'utente attualmente collegato
        $steps = Step::whereIn('travel_id', $range)->get();

        // creo una variabile con un array vuoto
        $range_steps = [];

        // itero i viaggi
        foreach ($steps as $step) {

            // pusho tutti gli id dei viaggi in range
            array_push($range_steps, $step->id);
        }

        return view('admin.dashboard', ['travels' => Travel::where('user_id', $id)->OrderByDesc('id')->take(4)->get(), 'steps' => Step::whereIn('travel_id', $range)->has('votes')->OrderByDesc('id')->take(4)->get(), 'notes' => Note::whereIn('step_id', $range_steps)->OrderByDesc('id')->take(4)->get()]);
    }
}
