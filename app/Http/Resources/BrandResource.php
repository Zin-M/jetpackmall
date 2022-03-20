<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
   
    public function toArray($request)
    {
        // return parent::toArray($request);
         $baseurl=URL('/');
        return[
            'brand_id'=>$this->id,
            'brand_name'=>$this->name,
            'brand_photo'=>$baseurl.'/'.$this->photo,
            'created_at'=>$this->created_at->format('d-m-Y'),
            'updated_at'=>$this->updated_at->format('d-m-Y'),
        ];
    }
}
