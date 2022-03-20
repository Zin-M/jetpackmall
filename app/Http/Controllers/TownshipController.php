<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Township;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $townships=Township::all();
         return view('backend.township.tlist',compact('townships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.township.tnew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator=$request->validate([
            'name'=>['required','string','max:255','unique:brands']]);
       
        if($validator)
        {
            $name=$request->name;
        $price=$request->price;
        // dd($name);
        // dd($photo);
        // file is_uploaded_file(filename)
       

        $township=new Township;
        $township->name=$name;
        $township->price=$price;
        $township->save();
        return redirect()->route('backside.township.index')->with("successMsg","New Township is added in your data");}
        else{
            return redirect::back()->withError($validator);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $township=Township::find($id);
        // dd($category);
        return view('backend.township.tedit',compact('township'));
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
       $name=$request->name;
       $price=$request->price;
        

        $township=township::find($id);
        $township->name=$name;
        $township->price=$price;
        $township->save();
        return redirect()->route('backside.township.index')->with('successMsg','Existing Township is UPDATED in your data'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $township=Township::find($id);
        $township->delete();
        return redirect()->route('backside.township.index')->with('successMsg','Existing Township is delete in your data');
    }
}
