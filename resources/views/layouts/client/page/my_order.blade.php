@extends('layouts.client.layout.master')
@section('titile','Product')
@section('content')
	<!-- Breacrumb Section Begin -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text">
						<a href="/"><i class="fa fa-home"></i>Home</a>
						<span>My Order</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breacrumb Section End -->

	<!-- My Order Section Begin -->
	<div class="shopping-cart spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<table>
							<thead>
								<tr>
									<th>Image</th>
									<th>ID</th>
									<th>Products</th>
									<th>Total</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody>
								@foreach($orders as $order)
								<tr>
									<td class="cart-pic first-row">
                                        <img style="height:100px; margin-left:75px;" src="front/img/products/{{$order->orderDetails[0]->product->productImages[0]->path}}"
                                             alt="">
                                    </td>
									<td class="first-row">#{{$order->id}}</td>
									<td class="card-title first-row">
										<h5>
											{{$order->orderDetails[0]->product->name}}

											@if(count($order->orderDetails) > 1)
											 (and {{count($order->orderDetails)}} other products)
											@endif
										</h5>
									</td>
									<td class="total-price first-row">
										${{ array_sum(array_column($order->orderDetails->toArray(),'total'))}}
									</td>
									<td class="first-row">
										<a href="/my-order/{{$order->id}}" class="btn">Detail</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- My Order Section End -->
@endsection
