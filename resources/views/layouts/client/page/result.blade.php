@extends('layouts.client.layout.master')
@section('titile','Order')
@section('content')

<!-- Checkout Section Begin -->
<div class="checkout-section spad">
	<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h4>{{$notification}}</h4>
					<a href="./" class="primary-btn mt-5">Tiếp tục mua sắm</a>
				</div>
			</div>
	</div>
</div>
<!-- Checkout Section End -->

@endsection