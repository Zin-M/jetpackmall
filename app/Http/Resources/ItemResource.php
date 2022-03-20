<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Category;
use App\Subcategory;
use App\Brand;
// use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubcategoryResource;
use App\Http\Resources\BrandResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $baseurl=URL('/');
        $photos=json_decode($this->photo);
        $photo=$baseurl.'/'.$photos[0];
        return[
            'item_id'=>$this->id,
            'item_name'=>$this->name,
            'item_codeno'=>$this->codeno,
            'item_price'=>$this->price,
            'item_photo'=>$photo,
            'item_photos'=>$photos,
            'item_discount'=>$this->discount,
            // 'category_id'=>$this->category_id,
            'brand_id'=>$this->brand_id,
            'subcategory_id'=>$this->subcategory_id,
            // 'category'=>new CategoryResource(Category::find($this->category_id)),
            'subcategory'=>new SubcategoryResource(Subcategory::find($this->subcategory_id)),
            'brand'=>new BrandResource(Brand::find($this->brand_id)),
            // 'subcategory_photo'=>$baseurl.'/'.$this->photo,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'updated_at'=>$this->updated_at->format('d-m-Y'),
        ];
    }
}
