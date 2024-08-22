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
        // salvo l'id dell'itinerario che viene passata
        $step_id = key($_GET);

        //salvo in una variabile i dati validati
        $val_data = $request->validated();

        // salvo nella chiave step_id l'id dell'itinerario
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

        // salvo nella chiave lo slug
        $val_data['slug'] = $slug;

        // salvo nella variabile la nota creata
        $note = Note::create($val_data);

        // renderizzo alla pagina precedente con un messaggio per la session
        return redirect()->back()->with('message', "Grazie per aver lasciato una nota $note->customer_name $note->customer_lastname");
    }
}
