@extends('layouts.client.layout.master')
@section('titile','Order')
@section('content')

<!-- Checkout Section Begin -->
<div class="checkout-section spad">
	<div class="container">
		<form action="" method="post" class="checkout-form">
			@csrf
			<div class="row">
				@if(Cart::count() > 0)
				<div class="col-lg-6">
					<div class="checkout-content">
						<a href="/account/login" class="content-btn">Click here to login</a>
					</div>
					<h4>Billing Details</h4>
					<div class="row">
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id ?? ''}} " >
						<div class="col-lg-6">
							<label for="fir">First Name <span>*</span></label>
							<input type="text" id="fir" name="first_name" value="{{Auth::user()->name ?? ''}}">
						</div>
						<div class="col-lg-6">
							<label for="last">Last Name <span>*</span></label>
							<input type="text" id="last" name="last_name">
						</div>
                        <div class="col-lg-6">
							<label for="phone">Phone <span>*</span></label>
							<input type="text" id="phone" name="phone" value="{{Auth::user()->phone ?? ''}}">
						</div>
						<div class="col-lg-6">
							<label for="email">Email <span>*</span></label>
							<input type="text" id="email" name="email" value="{{Auth::user()->email ?? ''}}">
						</div>
						<div class="col-lg-12">
							<label for="adress">Adress <span>*</span></label>
							<input type="text" id="adress" name="adress"value="{{Auth::user()->adress ?? ''}}">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="checkout-content">
						<input type="text" placeholder="Enter your coupon code">
					</div>
					<div class="place-order">
						<h4>Your order</h4>
						<div class="order-total">
							<ul class="order-table">
								<li>Product <span>Total</span></li>
								@foreach($carts as $cart)
								<li class="fw-normal">{{$cart->name}} x {{$cart->qty}} <span>${{$cart->price * $cart->qty}}</span></li>
								@endforeach
								<li class="total-price">Total <span>${{$total}}</span></li>
							</ul>
							<div class="payment-check">
								<div class="pc-item">
									<label for="pc-check">
										Thanh toán khi nhận hàng
										<input type="radio" id="pc-check" name="payment_type" value="pay_later">
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="pc-item">
									<label for="pc-paypal">
										Thanh toán online
										<input type="radio" id="pc-paypal" name="payment_type" value="online_payment">
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
							<div class="order-btn">
								<button type="submit" class="site-btn place-btn">Place Order</button>
							</div>
						</div>
					</div>
				</div>
				@else
				<div class="col-lg-12">
					<h4>Your cart is empty!!!</h4>
				</div>
				@endif
			</div>
		</form>
	</div>
</div>
<!-- Checkout Section End -->

@endsection
