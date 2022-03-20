<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories=Category::all();
        // dd($categories);
        return view('backend.category.list',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.new');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return view('ba')
        // dd($request);
        $validator=$request->validate([
            'name'=>['required','string','max:255','unique:categories'],
            'photo'=>'required|mimes:jpeg,bmp,png,jpg']);
       
        if($validator)
        {
            $name=$request->name;
        $photo=$request->photo;
        // dd($name);
        // dd($photo);
        // file is_uploaded_file(filename)
        $imageName=time().'.'.$photo->extension();
        $photo->move(public_path('images/category'),$imageName);
        $filepath='images/category/'.$imageName;

        $category=new Category;
        $category->name=$name;
        $category->photo=$filepath;
        $category->save();
        return redirect()->route('backside.category.index')->with("successMsg","New Category is added in your data");}
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
        $category=Category::find($id);
        // dd($category);
        return view('backend.category.edit',compact('category'));
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
        $newphoto=$request->photo;
        $oldphoto=$request->oldPhoto;
        // dd($name);
        if($request->hasFile('photo')){
             $imageName=time().'.'.$newphoto->extension();
            $newphoto->move(public_path('images/category'),$imageName);
            $filepath='images/category/'.$imageName;
            if(\File::exists(public_path($oldphoto))){
                \File::delete(public_path($oldphoto));
            }
        }

        
        else{
            $filepath=$oldphoto;
        }

        $category=Category::find($id);
        $category->name=$name;
        $category->photo=$filepath;
        $category->save();
        return redirect()->route('backside.category.index')->with('successMsg','Existing Category is UPDATED in your data');
        dd($newphoto);
        // dd($oldphoto);
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
        return redirect()->route('backside.category.index')->with('successMsg','Existing Category is delete in your data');
    }
}
