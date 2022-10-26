<?php

namespace App\Http\Controllers;

use App\Models\Spells;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SpellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spells = Spells::all();
        return response()->json($spells);
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
        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/spells'), $image_name);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);

        Spells::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'discription' => $request->discription,
            'image' => $image_name,
            'classes_id' => $request->classes_id,
            ]);
    
            // return redirect()->route('home') -> with([
            //     'success' => 'article ajoute'
            // ]);;
            return response()->json([
                'message' => 'Spell created'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spells  $spells
     * @return \Illuminate\Http\Response
     */
    public function show(Spells $spells, $slug)
    {
        $spell = Spells::where('slug',$slug)->first();

        return response()->json($spell);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spells  $spells
     * @return \Illuminate\Http\Response
     */
    public function edit(Spells $spells)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spells  $spells
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spells $spells, $slug)
    {
        $spell = Spells::where('slug',$slug)->first();

        if($request->hasFile("image")){
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/spells'), $image_name);
            unlink(public_path('uploads/spells') . '/' . $spell->image);
            $spell->image = $image_name;
        }
   
        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);
        
           $spell->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'discription' => $request->discription,
            'classes_id' => $request->classes_id,
            'image' => $spell->image,
           ]);

           return response()->json([
            'message' => 'spell Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spells  $spells
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spells $spells, $slug)
    {
        $spell = Spells::where('slug',$slug)->first();
        if (file_exists(public_path('uploads/spells') . '/' . $spell->image)) {
            
            unlink(public_path('uploads/spells') . '/' . $spell->image);
        }

        $spell->delete();

       return response()->json([
            'message' => 'spell Deleted'
        ]);
    }
}
