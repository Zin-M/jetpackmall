<x-frontend>
    
	<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg subtitle">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$brand->name}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>{{$brand->name}}</h2>
                        </div>
                        <div class="row">
                        	@if($branditems->count()>0)
                            <div class="product__discount__slider owl-carousel">
                            
                            	@foreach($branditems as $branditem)
                            	@php
                            	$id=$branditem->id;
                            	$codeno=$branditem->codeno;
                            	$name=$branditem->name;
                            	$unitprice=$branditem->price;
                            	$discountprice=$branditem->discount;
                            	$photos=json_decode($branditem->photo);
                            	$subcategory=$branditem->subcategory->name;
                            	$photo=$photos[0];
        
                            	@endphp
                                <div class="col-lg-4">
                                    <div class="product__discount__item img-fluid">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{asset($photo)}}" style="width:300px;height: 400px;">
                                            
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                                
                                                <li><a href="javascript:void(0)" class="addtocartBtn" 
                                                	data-id="{{$id}}"
                                                	data-name="{{$name}}"
                                                	data-codeno="{{$codeno}}"
                                                	data-unitprice="{{$unitprice}}"
                                                	data-discount="{{$discountprice}}"
                                                	data-photo="{{$photo}}"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="product__discount__item__text">
                                            <span>{{$subcategory}}</span>
                                            <h5><a href="#">{{Str::limit($name,20)}}</a></h5>
                                            @if($discountprice)
                                            <div class="product__item__price">{{$discountprice}}Ks <span>{{$unitprice}}Ks</span> </div>
                                            @else
                                            <div class="product__item__price">{{$unitprice}}Ks</div>
                                             @endif
                                        </div>
                                       
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="col-12"><img src="{{asset('no.png')}}">
                            </div>
                            @endif
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
</x-frontend>