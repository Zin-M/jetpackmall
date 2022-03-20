<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;
use App\Http\Resources\CategoryResource;


class SubcategoryResource extends JsonResource
{
   
     
    public function toArray($request)
    {
        // return parent::toArray($request);
         $baseurl=URL('/');
        return[
            'subcategory_id'=>$this->id,
            'subcategory_name'=>$this->name,
            'category_id'=>$this->category_id,
            'category'=>new CategoryResource(Category::find($this->category_id)),
            // 'subcategory_photo'=>$baseurl.'/'.$this->photo,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'updated_at'=>$this->updated_at->format('d-m-Y'),
        ];
    }
}
