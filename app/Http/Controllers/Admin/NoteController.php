<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Controllers\Controller;
use DateTime;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // renderizza alla pagina index delle note e passo le note
        return view('admin.notes.index', ['notes' => Note::OrderByDesc('id')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // trasformo la data (dato di tipo stringa) in un dato dateTime con la classe DateTime
        $dateTime = new DateTime($note->created_at);

        // formato la data come quella italiana
        $date = $dateTime->format('d/m/Y');

        // formato per prendere l'ora e i minuti
        $time = $dateTime->format('h:i');

        // renderizzo alla pagina show delle notte e passo la singola nota con la data e l'ora
        return view('admin.notes.show', compact('note', 'date', 'time'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {

        // variabile che salva il nome di note+
        $name = $note->name;

        // cancello note
        $note->delete();

        // ritorna alla pagina index
        return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
    }
}
