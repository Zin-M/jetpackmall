<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Item;
use App\Brand;
use Carbon\Carbon;
use App\Order;

class FrontendController extends Controller
{
    public function index(){
    	$categories=Category::all();
    	$topitems=Item::all()->random(4);
    	$latestitems=Item::latest()->take(4)->get();
    	$discountitems=Item::whereNotNull('discount')->take(4)->get();
    	// $discountitems=Item::whereNoNull('discount','>','0')->take(3)->get();

    	// $reviewitems=Item::all()->random(3);
    	return view('frontend.index',compact('categories','topitems','latestitems','discountitems'));
    }
    public function brand($id){
    	// dd($id);
    	$branditems=Item::where('brand_id',$id)->get();
    	$brand=Brand::find($id);
    	// dd($branditems);
    	return view('frontend.brand',compact('branditems','brand'));
    }
     public function promotion(){
    	// dd($id);
    	// $promotionitems=Item::where('',$id)->get();
    	// dd($branditems);
    	$promotionitems=Item::whereNotNull('discount')->paginate(3);
    	return view('frontend.promotion',compact('promotionitems'));
    }
     public function shoppingcart(){
        $shoppingcartitems=Item::all();
        
        return view('frontend.shoppingcart',compact('shoppingcartitems'));
    }
     public function ordersuccess(){
        
        return view('frontend.ordersuccess');
    }
     public function order(Request $request){

        $carts=json_decode($request->data);
        // dd($carts);
        $note=$request->note;
        $orderdate=Carbon::now();
        $voucherno=uniqid();
        $total=0;
        foreach($carts as $row){
            $unitprice=$row->unitprice;
            $discount=$row->discount;
            if($discount){
                $price=$discount;
            }else{
                $price=$unitprice;
            }
            $total+=$price+$row->qty;
        }
        $status='Order';
        $auth=Auth::user();
        $userid=$auth->id;
        $order=new Order;
        $order->orderdate=$orderdate;
        $order->voucherno=$voucherno;
        $order->total=$total;
        $order->note=$note;
        $order->status=$status;
        $order->user_id=$userid;
        $order->save();
        foreach($carts as $value){
            $itemid=$value->id;
            $qty=$value->qty;
            $order->items()->attach($itemid,['qty'=>$qty]);
        }
        return response()->json(['status'=>'Order successfully created']);
       
        
       
    }

}
