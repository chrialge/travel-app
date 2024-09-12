<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Travel;
use App\Models\Step;

class Notes extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
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



        $notes = Note::where(function ($query) {
            $query->where('customer_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('customer_lastname', 'LIKE', '%' . $this->search . '%')
                ->orWhere('customer_email', 'LIKE', '%' . $this->search . '%')
                ->orWhereRelation('step', 'name',  'LIKE', '%' . $this->search . '%');
        })->whereIn('step_id', $range_steps)->OrderByDesc('id')->paginate(7);

        return view('livewire.notes', compact('notes'));
    }
}
