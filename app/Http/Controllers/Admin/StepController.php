<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use App\Http\Requests\StoreStepRequest;
use App\Http\Requests\UpdateStepRequest;
use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        dd($val_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Step $step)
    {
        return view('admin.steps.show', compact('step'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStepRequest $request, Step $step)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step)
    {
        //
    }
}
