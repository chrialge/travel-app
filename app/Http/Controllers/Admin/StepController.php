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

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        $travels = Travel::where('user_id', $id)->get();
        $range = [];
        foreach ($travels as $travel) {
            array_push($range, $travel->id);
        }
        $steps = Step::whereIn('travel_id', $range)->orderByDesc('id')->paginate(6);
        return view('admin.steps.index', compact('steps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Auth::id();
        $travels = Travel::where('user_id', $id)->get();
        return view('admin.steps.create', compact('travels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStepRequest $request)
    {
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

        $val_data['location'] =  $val_data['state'] . ', ' . $val_data['region'] . ', Via' . $val_data['route'] . ', ' . $val_data['cap'];

        //salva lo slug nella nella key slug 
        $val_data['slug'] = $slug;

        $newStep = Step::create($val_data);

        return to_route('admin.steps.index')->with('message', "Hai creato l'itineraio $newStep->name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Step $step)
    {
        // dd($step);
        $travel = Travel::where('id', $step->travel_id)->get();

        if (Gate::allows('step_checker', $step)) {
            return view('admin.steps.show', compact('step'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Step $step)
    {
        // dd($step);
        $travel = Travel::where('id', $step->travel_id)->get();

        if (Gate::allows('step_checker', $step)) {
            $id = Auth::id();
            $travels = Travel::where('user_id', $id)->get();
            return view('admin.steps.edit', compact('step', 'travels'));
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStepRequest $request, Step $step)
    {

        if (Gate::allows('step_checker', $step)) {
            $val_data = $request->validated();

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

            $val_data['location'] =  $val_data['state'] . ', ' . $val_data['region'] . ', Via' . $val_data['route'] . ', ' . $val_data['cap'];

            // modifica travel con i nuovi dati
            $step->update($val_data);

            // rispedisce alla pagina index di travels
            return to_route('admin.steps.index')->with('message', "Hai modificato l'itinerario: $step->name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step)
    {

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

            // ritorna alla pagina index
            return redirect()->back()->with('message', "Hai cancellato il viaggio: $name");
        } //in caso ti esce errore 
        abort(403, "Non hai l'autorizzazione per accedere a questa pagina");
    }
}
