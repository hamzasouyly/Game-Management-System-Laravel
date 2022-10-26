<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Classes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Roles::all();
        return response()->json($roles);
        // return view('create') -> with([
        //     'roles' => $roles,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        

        $classes = Classes::all();
        return view('create') -> with([
            'classes' => $classes
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/roles'), $image_name);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);


        Roles::create([
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
                'message' => 'Role created'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles, $slug)
    {
        $role = Roles::where('slug',$slug)->first();

        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles, $slug)
    {
        //
        $role = Roles::where('slug',$slug)->first();

        if($request->hasFile("image")){
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/roles'), $image_name);
            unlink(public_path('uploads/roles') . '/' . $role->image);
            $role->image = $image_name;
        }
   
        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);
        
           $role->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'discription' => $request->discription,
            'classes_id' => $request->classes_id,
            'image' => $role->image,
           ]);

           return response()->json([
            'message' => 'Role Updated'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles, $slug)
    {
        //
        $role = Roles::where('slug',$slug)->first();
        if (file_exists(public_path('uploads/roles') . '/' . $role->image)) {
            
            unlink(public_path('uploads/roles') . '/' . $role->image);
        }

        $role->delete();

       return response()->json([
            'message' => 'Role Deleted'
        ]);
    }
}
