<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
// use App\SoftDeletes;

class Township extends Model
{
    // use SoftDeletes;
    protected $fillable=[
    	'name','price'];
}
