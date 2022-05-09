<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sector::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     // 'path' => 'required',
        //     'description' => 'required',
        //     'requirement' => 'required',
        //     'document' => 'required'
        // ]);
        // $image = $request->file('image');
        // $path = $image->store('public/images');
        // return Sector::create($request->all());

        $sectors=new Sector();
        $request->validate([
            'name' => 'required',
            'image' => 'required|max:1024',
            // 'path' => 'required',
            'description' => 'required',
            'requirement' => 'required',
            'document' => 'required|max:2048'
        ]);

        $filename="";
        $filename1="";
        if($request->hasFile('image')){
            $filename=$request->file('image')->store('posts','public');
        }else{
            $filename=Null;
        }

        if($request->hasFile('document')){
            $filename1=$request->file('document')->store('posts','public');
        }else{
            $filename=Null;
        }

        $sectors->name=$request->name;
        $sectors->image=$filename;
        $sectors->description=$request->description;
        $sectors->requirement=$request->requirement;
        $sectors->document=$filename1;
        $result=$sectors->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sector::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $sector = Sector::find($id);
        // $sector->update($request->all());
        // return $sector;

        $sectors=Sector::findOrFail($id);

        $destination=public_path("storage\\".$sectors->image);
        $filename="";
        if($request->hasFile('new_image')){
            if(File::exists($destination)){
                File::delete($destination);
            }
            $filename=$request->file('new_image')->store('posts', 'public');
        }else{
            $filename=$request->image;
        }
        $sectors->name=$request->name;
        $sectors->image=$filename;
        $sectors->description=$request->description;
        $sectors->requirement=$request->requirement;
        $sectors->document=$request->document;
        $result=$sectors->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Sector::destroy($id);
    }

     /**
     * Search for name of sectors.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Sector::where('name', 'like', '%'.$name. '%')->get();
    }
}
