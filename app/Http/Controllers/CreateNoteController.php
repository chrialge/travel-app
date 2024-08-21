<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Support\Str;
use App\Models\Note;

class CreateNoteController extends Controller
{
    public function index(StoreNoteRequest $request)
    {
        // dd($request->validated());
        $step_id = key($_GET);
        $val_data = $request->validated();
        $val_data['step_id'] = $step_id;

        // variabile che fa checker o salva il numero di travel con lo stesso nome
        $slug_checker = Note::where('customer_name', $val_data['customer_name'])->where('customer_lastname', $val_data['customer_lastname'])->count();

        // se esiste lo slug
        if ($slug_checker) {

            // variabile che salva lo slug
            $slug = Str::slug($val_data['customer_name'], '-') . '-' . Str::slug($val_data['customer_lastname'], '-') . '-' . $slug_checker + 1;
        } else {

            // variabile che salva lo slug
            $slug = Str::slug($val_data['customer_name'], '-') . '-' . Str::slug($val_data['customer_lastname'], '-');
        }

        $val_data['slug'] = $slug;

        $note = Note::create($val_data);

        return redirect()->back()->with('message', "Grazie per aver lasciato una nota $note->customer_name $note->customer_lastname");
    }
}
