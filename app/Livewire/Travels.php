<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Travels extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        // // variabile che salva l'id dell'utente che si e loggato
        // $id = Auth::id();

        // // variabile con tutti i viaggi nel db in ordine discendente in base chi si e loggato
        // $travels = Travel::where(function ($query) {
        //     $query->where('name', 'LIKE', '%' . $this->search . '%')
        //         ->orWhere('date_start', 'LIKE', '%' . $this->search . '%')
        //         ->orWhere('date_finish', 'LIKE', '%' . $this->search . '%');
        // })->where('user_id', $id)->orderByDesc('id')->paginate(5);

        $travels = Travel::orderByDesc('id')->paginate(5);

        return view('livewire.travels', compact('travels'));
    }
}
