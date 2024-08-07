<?php

namespace App\Http\Controllers\Admin;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Step;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // variabile che salva l'id dell'utente che si e loggato
        $id = Auth::id();

        // variabile con tutti i viaggi nel db in ordine discendente in base chi si e loggato
        $travels = Travel::where('user_id', $id)->orderByDesc('id')->paginate(5);

        // rispedisce alla pagina inde di travel con tutti i viaggi
        return view('admin.travels.index', compact('travels', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // rispedisce alla pagina creazione di travel
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelRequest $request)
    {
        // variabile con i dati validati
        $val_data = $request->validated();

        // se nella richiesta ce image
        if ($request->has('image')) {

            // viene inserita l'immagine nello storage
            $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
        };

        // variabile che fa checker o salva il numero di travel con lo stesso nome
        $slug_checker = Travel::where('name', $val_data['name'])->count();

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

        // salvo l'user_id
        $val_data['user_id'] = Auth::id();

        // crea un nuovo viaggio e lo inserisce nel db
        $travel = Travel::create($val_data);

        // rimanda nella pagina index di travel
        return to_route('admin.travels.index')->with('message', "Hai creato il viaggio: $travel->name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {




            $dateArray = [];
            $begin = new DateTime($travel->date_start);
            $varaiable = $begin->format('Y-m-d');
            if ($_GET) {
                $varaiable = key($_GET);
            }
            $end   = new DateTime($travel->date_finish);

            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                $array = [];
                $array = [
                    [
                        "value" => $i->format('Y-m-d'),
                        "format" => $i->format('d-m'),
                    ]
                ];
                array_push($dateArray, $array);
            }

            $step = Step::where('date', $varaiable)->where('travel_id', $travel->id)->get();            // dd($dateArray);
            // rispedisce alla pagina singola di un travel
            return view('admin.travels.show', compact('travel', 'dateArray', 'step'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {
            // rispedisce alla pagina di modifica
            return view('admin.travels.edit', compact('travel'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {
            // variabile con i dati validati
            $val_data = $request->validated();

            // se ce image
            if ($request->has('image')) {

                // se esiste l'immagine di travel
                if ($travel->image) {

                    // l'immagine viene cancellata da storage
                    Storage::disk('public')->delete($travel->image);
                }
                // imagine viene inserita in storage
                $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
            }

            // variabile che fa checker o salva il numero di travel con lo stesso nome
            $slug_checker = Travel::where('name', $val_data['name'])->count();

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

            // modifica travel con i nuovi dati
            $travel->update($val_data);

            // rispedisce alla pagina index di travels
            return to_route('admin.travels.index')->with('message', "Hai modificato il viaggio: $travel->name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        // se l'id dell'utente e uguale a quello del viaggio
        if (Gate::allows('travel_checker', $travel)) {

            // se esiste l'immagine di travel
            if ($travel->image) {

                // l'immagine viene cancellata da storage
                Storage::disk('public')->delete($travel->image);
            }

            // variabile che salva il nome di travel+
            $name = $travel->name;

            // cancello travel
            $travel->delete();

            // ritorna alla pagina index
            return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }
}
