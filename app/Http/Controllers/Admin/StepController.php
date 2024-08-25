<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Http\Requests\StoreStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Mockery\Undefined;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        $steps = Step::whereIn('travel_id', $range)->orderByDesc('id')->paginate(6);

        // renderizza alla pagina index degl'itenerari e passa gl'itenerari
        return view('admin.steps.index', compact('steps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //salvo in una variabile l'id del viaggio
        $travel_id = key($_GET);

        // salvo in una variabile l'id dell'utente attualmente collegato
        $id = Auth::id();

        // salvo in una varibile tutti i viaggi dell'utente attaulmente collegato
        $travels = Travel::where('user_id', $id)->get();

        // renderizzo alla pagina di creazione degl'itinerari e passo i viaggi 
        return view('admin.steps.create', compact('travels', 'travel_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStepRequest $request)
    {
        // salvo i dati validati
        $val_data = $request->validated();

        // se nella richiesta ce image
        if ($request->has('image')) {

            // viene inserita l'immagine nello storage
            $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
        } else {
            $val_data['image'];
        };

        // variabile che fa checker o salva il numero di travel con lo stesso nome
        $slug_checker = Step::where('name', $val_data['name'])->count();

        // se esiste lo slug
        if ($slug_checker) {

            // variabile che salva lo slug
            $slug = Str::slug($val_data['name'], '-') . '-' . $slug_checker + 1;
        } else {
            // variabile che salva lo slug
            $slug = Str::slug($val_data['name'], '-');
        }

        // salvo nella chiave location lo stato, la regione, la via e il cap
        $val_data['location'] =  $val_data['state'] . ', ' . $val_data['region'] . ', Via' . $val_data['route'] . ', ' . $val_data['cap'];

        //salva lo slug nella nella key slug 
        $val_data['slug'] = $slug;

        // salvo nella variabile l'itinerario creato
        $newStep = Step::create($val_data);

        // renderizzo alla pagina index dell'itinerario con un messaggio per la session
        return to_route('admin.steps.index')->with('message', "Hai creato l'itineraio $newStep->name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Step $step)
    {
        // // salvo il viaggio dell'itinerario
        // $travel = Travel::where('id', $step->travel_id)->get();

        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // renderizza alla pagina show dell'itinerario e passo il singolo itinerario
            return view('admin.steps.show', compact('step'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Step $step)
    {
        // // salvo il viaggio dell'itinerario
        // $travel = Travel::where('id', $step->travel_id)->get();

        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // salvo in una variabile l'id dell'utente attualmente collegato
            $id = Auth::id();

            // salvo in una varibile tutti i viaggi dell'utente attaulmente collegato
            $travels = Travel::where('user_id', $id)->get();

            // renderizzo alla pagina di modifica dell'itinerario e passo gl'itinerari e viaggi
            return view('admin.steps.edit', compact('step', 'travels'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStepRequest $request, Step $step)
    {
        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // salvo i dati validati
            $val_data = $request->validated();

            // se nella richiesta ce image
            if ($request->has('image')) {

                // se esiste l'immagine di travel
                if ($step->image) {

                    // l'immagine viene cancellata da storage
                    Storage::disk('public')->delete($step->image);
                }
                // imagine viene inserita in storage
                $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
            }

            // variabile che fa checker o salva il numero di travel con lo stesso nome
            $slug_checker = Step::where('name', $val_data['name'])->count();

            // se esiste lo slug
            if ($slug_checker) {

                // variabile che salva lo slug
                $slug = Str::slug($val_data['name'], '-') . '-' . $slug_checker + 1;
            } else {

                // variabile che salva lo slug
                $slug = Str::slug($val_data['name'], '-');
            }

            //salva lo slug nella nella key slug 
            $val_data['slug'] = $slug;

            // salvo nella chiave location lo stato, la regione, la via e il cap
            $val_data['location'] =  $val_data['state'] . ', ' . $val_data['region'] . ', Via' . $val_data['route'] . ', ' . $val_data['cap'];

            // modifica travel con i nuovi dati
            $step->update($val_data);

            // renderizzo alla pagina index dell'itinerario con un messaggio per la session
            return to_route('admin.steps.index')->with('message', "Hai modificato l'itinerario: $step->name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step)
    {
        // se l'itinerario e quello creato dall'utente attualmente collegato
        if (Gate::allows('step_checker', $step)) {

            // se esiste l'immagine di travel
            if ($step->image) {

                // l'immagine viene cancellata da storage
                Storage::disk('public')->delete($step->image);
            }

            // variabile che salva il nome di step+
            $name = $step->name;

            // cancello step
            $step->delete();

            // renderizzo alla pagina precedente con un messaggio per la session
            return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * funzione che cerca gli itinerari che corrispondono al valore della chiave searchable
     */
    public function search()
    {
        session_start();

        if (isset($_GET['searchable'])) {
            $search_text = $_GET['searchable'];
            $_SESSION['search'] = $search_text;
        } else {
            // dd($_SESSION);
            $search_text = $_SESSION['search'];
        }

        $steps = Step::where('name', 'LIKE', '%' . $search_text . '%')
            ->orWhere('date', 'LIKE', '%' . $search_text . '%')
            ->orWhereRelation('travel', 'name',  'LIKE', '%' . $search_text . '%')->paginate(6);


        return view('admin.steps.index', compact('steps'));
    }
}
