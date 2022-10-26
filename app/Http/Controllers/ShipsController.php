<?php

namespace App\Http\Controllers;

use App\Models\Ships;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ShipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ships = Ships::all();
        return response()->json($ships);
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
        

        if ($request->has('background')) {
            $file = $request->background;
            $background_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ships'), $background_name);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
        ]);
        
        Ships::create([
            'title' => $request->title,
            'discription' => $request->discription,
            'background' => $background_name,
            'type' => $request->type,
            'slug' => Str::slug($request->title),
            'equipment_id' => $request->equipment_id,
            ]);
    
            // return redirect()->route('home') -> with([
            //     'success' => 'article ajoute'
            // ]);;
            return response()->json([
                'message' => 'Ship created'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ships  $ships
     * @return \Illuminate\Http\Response
     */
    public function show(Ships $ships, $slug)
    {
        $ship = Ships::where('slug',$slug)->first();

        return response()->json($ship);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ships  $ships
     * @return \Illuminate\Http\Response
     */
    public function edit(Ships $ships)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ships  $ships
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ships $ships, $slug)
    {
        $ship = Ships::where('slug',$slug)->first();

        if($request->hasFile("background")){
            $file = $request->background;
            $background_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ships'), $background_name);
            unlink(public_path('uploads/ships') . '/' . $ship->background);
            $ship->background = $background_name;
        }
        
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);
        
           $ship->update([
            'title' => $request->title,
            'discription' => $request->discription,
            'background' => $ship->background,
            'type' => $request->type,
            'slug' => Str::slug($request->title),
            'equipment_id' => $request->equipment_id,
           ]);

           return response()->json([
            'message' => 'Ship Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ships  $ships
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ships $ships, $slug)
    {
        $ship = Ships::where('slug',$slug)->first();

        $ship->delete();

       return response()->json([
            'message' => 'Ship Deleted'
        ]);
    }
}
