<x-backend>
	 @php
        $id = $item->id;
        $name = $item->name;
        $codeno = $item->codeno;
        $oldphoto = $item->photo;
        $unitprice = $item->price;

      
        $description = $item->description;
        $subcategory_id = $item->subcategory_id;
        $brand_id = $item->brand_id;
         $photos = json_decode($item->photo);
         $photo = $photos[0];
       
    @endphp
    
	<div class="jumbotron" style="margin-left: 20%;">
  <h1 class="display-4">{{($name)}}</h1>
  <p class="lead">Codeno:{{($codeno)}}<br><img src="{{asset($photo)}}"><br></p>
  <hr class="my-4">
  <p>{{$unitprice}}Ks<br></p>
  <p>Brand:{{$item->brand->name}}</p>
  <p>Subcategory:{{$item->subcategory->name}}</p>
  
</div>
</x-backend>