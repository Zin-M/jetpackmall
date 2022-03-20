<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subcategory;
// use App\Category;
use App\Http\Resources\SubcategoryResource;
use Validator;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=Subcategory::all();
        $result=SubcategoryResource::collection($subcategories);
        $message='Subcategory retrieved successfully.';
        $status=200;
        $response=[
            'status'=>$status,
            'success'=>true,
            'message'=>$message,
            'data'=>$result,




        ];
    return response()->json($response);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator=Validator::make($request->all(),[
            'name'=>'required','string','max:255','unique:categories',
            'categoryid'=>'required|numeric|min:0|not_in:0']);

        
        $name=$request->name;
        $categoryid=$request->categoryid;
        // dd($categoryid);
        // Data inset
        $subcategory=new Subcategory();
        $subcategory->name=$name;
        $subcategory->category_id=$categoryid;
        $subcategory->save();
         $status=200;
        $message='Subcategory created successfully';
        $result=new SubcategoryResource($subcategory);
        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$result,];
            return response()->json($response);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $subcategory=Subategory::find($id);
        if(is_null($subcategory)){
            $status=404;
            $message='Category not found';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message,

            ];

           
        }else{
            $status=200;
            $message='Category retrieved successfully';
            $result=new SubcategoryResource($subcategory);
            $response=[
                'status'=>$status,
                'success'=>true,
                'message'=>$message,
                'data'=>$result
            ];
            
        }
         return response()->json($response);
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
         $subcategory= Subcategory::find($id);
       
            $name = $request->name;
           
            $categoryid = $request->categoryid;


            // FILE UPLOAD

           
            // $photoString = implode(',', $data);

           
            $subcategory->name = $name;
            $subcategory->category_id = $categoryid;
            
            $subcategory->save();
            $status=200;
        $result=new SubcategoryResource($subcategory);
        $message='Subcategory updated successfully';
        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$result];
            return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $subcategory=Subcategory::find($id);
         if(is_null($subcategory)){
            $status=404;
            $message='Subcategory not found';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message,

            ];
            return response()->json($response);

           
        }
        else
        {
        
        $subcategory->delete();
        $status=200;
        $message='Subcategory deleted successfully';
        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message];
        
            return response()->json($response);
        }
}
}
