<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();

        
        return view('backend.subcategory.sublist',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('backend.subcategory.subnew',compact('categories'));
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
            'name'=>['required','string','max:255','unique:categories'],
            'categoryid'=>'required|numeric|min:0|not_in:0']);

        if($validator){
        $name=$request->name;
        $categoryid=$request->categoryid;
        // dd($categoryid);
        // Data inset
        $subcategory=new Subcategory();
        $subcategory->name=$name;
        $subcategory->category_id=$categoryid;
        $subcategory->save();
        return redirect()->route('backside.subcategory.index')->with('successMsg','New Subcategory is add in your data');}
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
         $categories = Category::all();
        // $brands = Brand::all();

        $subcategory = Subcategory::find($id);

        return view('backend.subcategory.subedit',compact('subcategory','categories'));
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
         $validator = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
        ]);

        if ($validator) {
            $name = $request->name;
           
            $categoryid = $request->categoryid;


            // FILE UPLOAD

           
            // $photoString = implode(',', $data);

            $subcategory= Subcategory::find($id);
            $subcategory->name = $name;
            $subcategory->category_id = $categoryid;
            
            $subcategory->save();

            return redirect()->route('backside.subcategory.index')->with("successMsg", "New Item is UPDATED in your data");


        }else{
            return Redirect::back()->withErrors($validator);
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
         $subcategory = subcategory::find($id);
        $subcategory->delete();

        return redirect()->route('backside.subcategory.index')->with("successMsg", "New Subcategory is DELETED in your data");
    }
    
}
