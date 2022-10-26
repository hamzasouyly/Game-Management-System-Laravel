<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Specialisation;

class SpecialisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialisations = Specialisation::all();
        return response()->json($specialisations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);
        
        Specialisation::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'classes_id' => $request->classes_id,
            ]);
    
            // return redirect()->route('home') -> with([
            //     'success' => 'article ajoute'
            // ]);;
            return response()->json([
                'message' => 'specialisation created'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialisation  $specialisation
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $specialisation = Specialisation::where('slug',$slug)->first();

        return response()->json($specialisation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialisation  $specialisation
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialisation $specialisation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialisation  $specialisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $specialisation = Specialisation::where('slug',$slug)->first();

        
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);
        
           $specialisation->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'classes_id' => $request->classes_id,
           ]);

           return response()->json([
            'message' => 'specialisation Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialisation  $specialisation
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $specialisation = Specialisation::where('slug',$slug)->first();

        $specialisation->delete();

       return response()->json([
            'message' => 'specialisation Deleted'
        ]);
    }
}
