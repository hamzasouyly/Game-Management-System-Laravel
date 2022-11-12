<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use App\Models\Roles;
use App\Models\Classes;
use App\Models\images_female;
use App\Models\images_male;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $classes = Classes::all();
        return response()->json($classes);
        // return view('home') -> with([
        //     'classes' => $classes,
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
        $nfts = Nft::all();
        // return view('createClasses') -> with([
        //     'nfts' => $nfts,
        // ]);
        return response()->json($nfts);
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
            $file->move(public_path('uploads/backgrounds'), $image_name);
            // Classes::create([
            //     'title' => $request->title,
            //     'slug' => Str::slug($request->title),
            //     'discription' => $request->discription,
            //     'image' => $image_name,
            //     // 'user_id' => auth()->user()->id,
            //     'nft_id' => $request->nft_id,
            //     ]);
        }

        if ($request->has('cover')) {
            $file = $request->cover;
            $cover_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cover'), $cover_name);
        }

        if ($request->has('icon')) {
            $file = $request->icon;
            $icon_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/icon'), $icon_name);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);
        
        $classes = Classes::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'discription' => $request->discription,
            'image' => $image_name,
            // 'user_id' => auth()->user()->id,
            'nft_id' => $request->nft_id,
            'cover' => $cover_name,
            'icon' => $icon_name,
        ]);
       $classes->save();

        // images male

        if ($request->has('imagesMale')) {
            $files = $request->imagesMale;
            foreach ($files as $file) {
                $image_name = time() . '_' . $file->getClientOriginalName();
                $request['classes_id']=$classes->id;
                $request['imageM']=$image_name;
                $file->move(public_path('uploads/imagesMale'), $image_name);
                images_male::create($request->all());
            }
           
        }
        // images female

        if ($request->has('imagesFemale')) {
            $files = $request->imagesFemale;
            foreach ($files as $file) {
                $image_name = time() . '_' . $file->getClientOriginalName();
                $request['classes_id']=$classes->id;
                $request['imageF']=$image_name;
                $file->move(public_path('uploads/imagesFemale'), $image_name);
                images_female::create($request->all());
            }
           
        }
    
       
        

        // return redirect()->route('home.index') -> with([
        //     'success' => 'Class ajoute'
        // ]);;
        return response()->json([
            'message' => 'Class created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes, $slug)
    {
        //
        $class = Classes::where('slug',$slug)->first();

        return response()->json($class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $classes, $slug)
    {
        $class = Classes::where('slug',$slug)->first();
        $nfts = Nft::all();
        // return view('editClasses') -> with([
        //     'nfts' => $nfts,
        //     'class' => $class,
        // ]);
        return response()->json($class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $class = Classes::where('slug',$slug)->first();

        if($request->hasFile("image")){
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/backgrounds'), $image_name);
            unlink(public_path('uploads/backgrounds') . '/' . $class->image);
            $class->image = $image_name;
        }

        if($request->hasFile("cover")){
            $file = $request->cover;
            $cover_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/cover'), $cover_name);
            unlink(public_path('uploads/cover') . '/' . $class->cover);
            $class->cover = $cover_name;
        }

        if($request->hasFile("icon")){
            $file = $request->icon;
            $icon_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/icon'), $icon_name);
            unlink(public_path('uploads/icon') . '/' . $class->icon);
            $class->icon = $icon_name;
        }
   
        $this->validate($request, [
            'title' => 'required|max:255',
            'discription' => 'required|min:10',
        ]);
        
           $class->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'discription' => $request->discription,
            'image' => $class->image,
            'cover' => $class->cover,
            'icon' => $class->icon,
            // 'user_id' => auth()->user()->id,
            'nft_id' => $request->nft_id,
           ]);

        //    images male

    //        $imagesM=images_male::where("classes_id",$class->id)->get();
    //        foreach($imagesM as $imageM){
    //       if (file_exists(public_path('uploads/imagesMale') . '/' . $imageM->imageM)) {
               
    //        unlink(public_path('uploads/imagesMale') . '/' . $imageM->imageM);
           
    //        }
    //    };
    //    images_male::where("classes_id",$class->id)->delete();

       //    images Female

        //     $imagesF=images_female::where("classes_id",$class->id)->get();
        //     foreach($imagesF as $imageF){
        //     if (file_exists(public_path('uploads/imagesFemale') . '/' . $imageF->imageF)) {
                
        //     unlink(public_path('uploads/imagesFemale') . '/' . $imageF->imageF);
            
        //     }
        // };
        // images_female::where("classes_id",$class->id)->delete();

    //    images male
   
           if($request->has('imagesMale')){

            $imagesM=images_male::where("classes_id",$class->id)->get();
            foreach($imagesM as $imageM){
           if (file_exists(public_path('uploads/imagesMale') . '/' . $imageM->imageM)) {
                
            unlink(public_path('uploads/imagesMale') . '/' . $imageM->imageM);
            
            }
        };
        images_male::where("classes_id",$class->id)->delete();

               $files = $request->imagesMale;
            foreach ($files as $file) {
                $image_name = time() . '_' . $file->getClientOriginalName();
                $request['classes_id']=$class->id;
                $request['imageM']=$image_name;
                $file->move(public_path('uploads/imagesMale'), $image_name);
                images_male::create($request->all());
            }
           
           }

    //    images Female
   
           if($request->has('imagesFemale')){

            $imagesF=images_female::where("classes_id",$class->id)->get();
            foreach($imagesF as $imageF){
            if (file_exists(public_path('uploads/imagesFemale') . '/' . $imageF->imageF)) {
                
            unlink(public_path('uploads/imagesFemale') . '/' . $imageF->imageF);
            
            }
        };
        images_female::where("classes_id",$class->id)->delete();

            $files = $request->imagesFemale;
         foreach ($files as $file) {
             $image_name = time() . '_' . $file->getClientOriginalName();
             $request['classes_id']=$class->id;
             $request['imageF']=$image_name;
             $file->move(public_path('uploads/imagesFemale'), $image_name);
             images_female::create($request->all());
         }
         
        }
           

        

        // return redirect()->route('home.index') -> with([
        //     'success' => 'Class Updated'
        // ]);;
        return response()->json([
            'message' => 'Class Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes, $slug)
    {
        $class = Classes::where('slug',$slug)->first();
        if (file_exists(public_path('uploads/backgrounds') . '/' . $class->image)) {
            
            unlink(public_path('uploads/backgrounds') . '/' . $class->image);
            

        }

        if (file_exists(public_path('uploads/cover') . '/' . $class->cover)) {
            
            unlink(public_path('uploads/cover') . '/' . $class->cover);
            

        }

        if (file_exists(public_path('uploads/icon') . '/' . $class->icon)) {
            
            unlink(public_path('uploads/icon') . '/' . $class->icon);
            

        }
        

       
        $imagesM=images_male::where("classes_id",$class->id)->get();
        foreach($imagesM as $imageM){
       if (file_exists(public_path('uploads/imagesMale') . '/' . $imageM->imageM)) {
            
        unlink(public_path('uploads/imagesMale') . '/' . $imageM->imageM);
        
        }
    }

    // image female

    $imagesF=images_female::where("classes_id",$class->id)->get();
        foreach($imagesF as $imageF){
       if (file_exists(public_path('uploads/imagesFemale') . '/' . $imageF->imageF)) {
            
        unlink(public_path('uploads/imagesFemale') . '/' . $imageF->imageF);
        
        }
    }
        

       $class->delete();
       images_male::where("classes_id",$class->id)->delete();
       images_female::where("classes_id",$class->id)->delete();

    //    return redirect()->route('home.index') -> with([
    //     'success' => 'Classes deleted'
    // ]);;
    return response()->json([
        'message' => 'Class Deleted'
    ]);
    }

//     public function deleteimageM($id){
//         $imagesM=images_male::findOrFail($id);
//         if (File::exists("uploads/imagesMale/".$imagesM->imageM)) {
//            File::delete("uploads/imagesMale/".$imagesM->imageM);
//        }

//        images_male::find($id)->delete();
//        return back();
//    }

//    public function deletebackground($id){
//     $background=Classes::findOrFail($id)->cover;
//     if (File::exists("uploads/backgrounds/".$background)) {
//        File::delete("uploads/backgrounds/".$background);
//    }
//    return back();
// }
}
