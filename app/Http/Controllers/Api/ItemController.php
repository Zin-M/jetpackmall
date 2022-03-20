<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Validator;

use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $items=Item::all();
        $result=ItemResource::collection($items);
        $message='Item retrieved successfully.';
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
         $validator=Validator::make($request->all(),['name'=>'required|string|max:255|unique:categories',
            'photo'=>'required|mimes:jpeg,bmp,png,jpg']);

        if ($validator) {
            $name = $request->name;
            $images=$request->images;
            $unitprice = $request->unitprice;
            $discount = $request->discount;
            $description = $request->description;
            $brandid = $request->brandid;
            $subcategoryid = $request->subcategoryid;
            //dd($request->images);

            // FILE UPLOAD
            dd($request->file('images'));
            
             if ($request->images) 
            {
                dd("Ok");
                $i=1;
                foreach($request->file('images') as $image)
                {
                    dd("Ok");
                    /*$imagename = time().$i.'.'.$image->extension();
                    $image->move(public_path('images/item'), $imagename);  
                    $data[] = 'images/item/'.$imagename;
                    $i++;*/
                }
            }
            // $photoString = implode(',', $data);
/*
            $codeno = "JPM-".rand(11111,99999);

            $item= new Item();
            $item->codeno = $codeno;
            $item->name = $name;
            $item->photo = json_encode($data);
            $item->price = $unitprice;
            $item->discount = $discount;
            $item->description = $description;
            $item->subcategory_id = $subcategoryid;
            $item->brand_id = $brandid;
            $item->save();
             $status=200;
        $message='Item created successfully';
        $result=new ItemResource($item);
        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$result,];
             return response()->json($response);*/
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
