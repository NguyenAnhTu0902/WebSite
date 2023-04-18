@extends('layouts.client.layout.master')
@section('titile','Cart')
@section('content')
<!-- Shopping Cart Section Begin -->
	<div class="shopping-cart spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<table>
							<thead>
								<tr>
									<th>Image</th>
									<th class="p-name">Product Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									<th><i class="ti-close"></i></th>
								</tr>
							</thead>
							<tbody>
                            @foreach($carts as $cart)
								<tr data-rowId="{{$cart->rowId}}">
                                    @foreach($products as $product)
                                    @if($cart->id == $product -> id )
									<td class="cart-pic first-row"><img src="front/img/products/{{$product->productImages[0]->path}}" alt=""></td>
                                        @endif
                                    @endforeach
									<td class="cart-title first-row">
										<h5>{{$cart->name}}</h5>
									</td>
									<td class="p-price first-row">${{number_format($cart->price,2)}}</td>
									<td class="qua-col first-row">
										<div class="quantity">
											<div class="pro-qty">
												<input disabled="disabled" type="number" value="{{$cart -> qty}}" data-rowid="{{$cart->rowId}}" min="0">
											</div>
										</div>
									</td>
									<td class="total-price first-row">${{number_format($cart->price * $cart->qty, 2)}}</td>
									<td class="close-td first-row">
										<i onclick="removeCart('{{$cart->rowId}}')" class="ti-close"></i>
									</td>
								</tr>
                            @endforeach
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="cart-buttons">
								<a href="#" class="primary-btn continue-shop">Continue shopping</a>
								<a href="/shop" class="primary-btn up-cart">Update cart</a>
							</div>
							<div class="discount-coupon">
								<h6>Discount Codes</h6>
								<form action="#" class="coupon-form">
									<input type="text" placeholder="Enter your codes">
									<button type="submit" class="site-btn coupon-btn">Apply</button>
								</form>
							</div>
						</div>
						<div class="col-lg-4 offset-lg-4">
							<div class="proceed-checkout">
								<ul>
									<li class="cart-total">Total <span>${{Cart::total()}}</span></li>
								</ul>
								<a href="/order" class="proceed-btn">PROCEED TO CHECK OUT</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Shopping Cart Section End -->


@endsection
