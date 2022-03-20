<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestOneController extends Controller
{
    public function index(){
    	return view('hi');
    }
    public function user($name,$position,$city){
    	// var_dump($name,$position,$city);die();
    	// dd($name,$position,$city);
    	$data=array('name'=>$name,'position'=>$position,'city'=>$city);
    	// dd($data);
    	return view('usertest',$data);
    }
}
