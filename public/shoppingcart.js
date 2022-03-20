$(document).ready(function(){
	cartNoti();
	showTable();
	$('.addtocartBtn').on('click',function(){
			var id=$(this).data('id');
			var name=$(this).data('name');
			var photo=$(this).data('photo');
			var codeno=$(this).data('codeno');
			var unitprice=$(this).data('unitprice');
			var discount=$(this).data('discount');
			var qty=1;

			//console.log("ID:"+id+"name:"+name+"photo:"+photo+"price:"+price+"discount:"+discount);
			var myList={id:id,codeno:codeno,name:name, photo:photo ,unitprice:unitprice,discount:discount,qty:qty};
			var cart=localStorage.getItem('cart');
			console.log(myList);
			if(cart==null){
				cartArray=Array();

			}else{
				cartArray=JSON.parse(cart);
			}
			
			var status=false;
			$.each(cartArray,function(i,v){
				if(id==v.id){
					v.qty++;
					status=true;
				}
			});
			if (!status) {
				cartArray.push(myList);
			}
			var cartData=JSON.stringify(cartArray);
			localStorage.setItem("cart",cartData);
			cartNoti();

	});
	function cartNoti(){
		var cart=localStorage.getItem('cart');

		if (cart) {
				var cartArray=JSON.parse(cart);
				var total=0;
				var noti=0;
				$.each(cartArray,function(i,v){
					var unitprice=v.price;
					var discount=v.discount;
					var qty=v.qty;
					if(discount){
						var price=discount;
					}else{
						var price=unitprice;
					}

					var subtotal=price*qty;
					noti+=qty++;
					total+=subtotal++;
				});
				$('.shoppingcartNoti').html(noti);
				$('.shoppingcartTotal').html(total+'Ks');

		}else{
			$('.shoppingcartNoti').html(0);
			$('.shoppingcartTotal').html(0+'Ks');
		}
	}

		function showTable(){

		var cart=localStorage.getItem('cart');
		if(cart){
			$('.shoppingcart_div').show();
			$('.noneshoppingcart_div').hide();
			var cartArray=JSON.parse(cart);
			var shoppingcartData='';
				if (cartArray.length>0) {
					var total=0;
					$.each(cartArray,function(i,v){
						var id=v.id;
						//console.log(id);
						var name=v.name;
						var unitprice=v.price;
						var discount=v.discount;
						var photo=v.photo;
						//console.log(photo);
						var qty=v.qty;

						if (discount) {
							var price=discount;

						}else{
							var price=unitprice;
						}
						var subtotal=price*qty;
						shoppingcartData+=`<tr>
											<td><p style="float:left;"><img src="${photo}" class="shoping__cart__item" style="width:100px;"> ${name}<p> </td>
												<td>`;
							if(discount){
							shoppingcartData+=`<p class="text-danger">${discount}Ks</p>
													<p class="font-weight-lighter"><del>${price}Ks</del></p>
													`;
							}else{
								shoppingcartData+=`<p class="text-danger"><del>${price}Ks</del></p>`;
							}


							shoppingcartData+=`</td>

												<td class="shoping__cart__quantity">
												<div class="quantity" >
												
												<div class="pro-qty"> <button class="plus_btn" data-id="${i}">+</button>
												<input type="text" value=" ${qty}">
												<button class="minus_btn" data-id="${i}">-</button>
												</div>
												
												</div>
												</td>
												<td><p>${subtotal}</p></td>
												<td><button class="btn btn-outline-danger remove btn-sm"  data-id="${i}" style="border-radius: 50%"> 
														<i class="icofont-close-line"></i> 
													</button> 
												</td>
												
											</tr>`;

						total+=subtotal++;
					});

					$('#shoppingcart_table').html(shoppingcartData);
				}else{
					$('.shoppingcart_div').hide();
					$('.noneshoppingcart_div').show();

				}


		}else{
			$('.shoppingcart_div').hide();
			$('.noneshoppingcart_div').show();
		}
	}

	$('#shoppingcart_table').on('click','.plus_btn',function(){
		// alert("right");
		var id=$(this).data('id');
		//console.log(id);
		var cart=localStorage.getItem('cart');
		var itemArray=JSON.parse(cart);
			$.each(itemArray,function(i,v){
				if(i==id){
					v.qty++;
					
				}
			});
			cart=JSON.stringify(itemArray);
			localStorage.setItem("cart",cart);
			showTable();
			cartNoti();
	});


	$('#shoppingcart_table').on('click','.minus_btn',function(){
		var id=$(this).data('id');
		// console.log(id);
		var cart=localStorage.getItem("cart");
		var itemArray=JSON.parse(cart);
			$.each(itemArray,function(i,v){
				if(i==id){
					v.qty--;
					if(v.qty==0){
						itemArray.splice(id,1);
					}
				}
			});
			cart=JSON.stringify(itemArray);
			localStorage.setItem("cart",cart);
			showTable();
			cartNoti();
	});
	$('#shoppingcart_table').on('click','.remove',function(){
		var id=$(this).data('id');
		// console.log(id);
		var cart=localStorage.getItem("cart");
		var itemArray=JSON.parse(cart);
			$.each(itemArray,function(i,v){
				if(i==id){
					itemArray.splice(id,1);
				}
			});
			cart=JSON.stringify(itemArray);
			localStorage.setItem("cart",cart);
			showTable();
			cartNoti();
	});

	$('.checkoutBtn').click(function(){
		
		var cart=localStorage.getItem("cart");
		// var cartArray=JSON.parse(cart);
		var note=$('#notes').val();
		$.ajaxSetup({
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}
		});
		// console.log(cart);
		// console.log(note);
		$.post('/order',{
			data:cart,
			note:note
		},function(response){
			localStorage.clear();
			location.href='ordersuccess';


		});
		// console.log(note);
	});

	

});