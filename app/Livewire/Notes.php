<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;
    public $search = '';

    public function render()
    {
        $notes = Note::where('customer_name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('customer_lastname', 'LIKE', '%' . $this->search . '%')
            ->orWhere('customer_email', 'LIKE', '%' . $this->search . '%')
            ->orWhereRelation('step', 'name',  'LIKE', '%' . $this->search . '%')->OrderByDesc('id')->paginate(7);

        return view('livewire.notes', compact('notes'));
    }
}
