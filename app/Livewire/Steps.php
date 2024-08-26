<?php

namespace App\Livewire;

use App\Models\Step;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Travel;
use Livewire\WithPagination;

class Steps extends Component
{
    use WithPagination;
    public $search = '';


    public function render()
    {


        // salvo in una variabilel'id dell'utente attualmente collegato
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

        // salvo in una variabile tutti gli itinerari che hanno gli id dei viaggi, vengo ordinati in ordine decrescente
        $steps = Step::where('name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('date', 'LIKE', '%' . $this->search . '%')
            ->orWhereRelation('travel', 'name',  'LIKE', '%' . $this->search . '%')->orderByDesc('id')->paginate(6);
        return view('livewire.steps', compact('steps'));
    }
}
