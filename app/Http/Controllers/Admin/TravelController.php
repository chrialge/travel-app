<?php

namespace App\Http\Controllers\Admin;

use App\Models\Travel;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTravelRequest;
use App\Http\Requests\UpdateTravelRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // variabile con tutti i viaggi nel db
        $travels = Travel::orderByDesc('id')->paginate(5);

        // rispedisce alla pagina inde di travel con tutti i viaggi
        return view('admin.travels.index', compact('travels'));
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
        // rispedisce alla pagina singola di un travel
        return view('admin.travels.show', compact('travel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        // rispedisce alla pagina di modifica
        return view('admin.travels.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, Travel $travel)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        if ($travel->image) {
            Storage::disk('public')->delete($travel->image);
        }
        $name = $travel->name;
        $travel->delete();
        return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
    }
}
