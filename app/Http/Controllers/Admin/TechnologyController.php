<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Technology;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $technologyData = $request->validate([
            'title' => 'required|string|max:32',
            'slug' => 'nullable|string|max:32'
        ]);

        $technology = Technology::create($technologyData);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $technology = Technology::where('slug', $slug)->firstOrFail();
        $technologyData = $request->validate([
            'title' => 'required|string|max:32',
            'slug' => 'nullable|string|max:32'
        ]);

        $technology->update($technologyData);

        return redirect()->route('admin.technologies.show', ['technology' => $technology->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        
        return redirect()->route('admin.types.index');
    }
}
