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
        $travels = Travel::all();
        return view('admin.travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.travels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelRequest $request)
    {
        $val_data = $request->validated();
        // dd($val_data);

        if ($request->has('image')) {
            $val_data['image'] = Storage::disk('public')->put('uploads/images', $val_data['image']);
        };
        $slug_checker = Travel::where('name', $val_data['name'])->count();
        if ($slug_checker) {
            $slug = Str::slug($val_data['name'], '-') . '-' . $slug_checker + 1;
        } else {
            $slug = Str::slug($val_data['name'], '-');
        }
        $val_data['slug'] = $slug;
        $travel = Travel::create($val_data);

        return to_route('admin.travels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        return view('admin.travels.show', compact('travel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travel $travel)
    {
        return view('admin.travels.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelRequest $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travel $travel)
    {
        //
    }
}
