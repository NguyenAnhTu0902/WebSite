<style>
	/* Rating */

	.rate {
	    float: left;
	    height: 46px;
	    padding: 0 10px;
	}
	.rate:not(:checked) > input {
	    display: none;
	}
	.rate:not(:checked) > label {
	    float:right;
	    width:1em;
	    overflow:hidden;
	    white-space:nowrap;
	    cursor:pointer;
	    font-size:30px;
	    color:#ccc;
	}
	.rate:not(:checked) > label:before {
	    content: '★ ';
	}
	.rate > input:checked ~ label {
	    color: #ffc700;
	}
	.rate:not(:checked) > label:hover,
	.rate:not(:checked) > label:hover ~ label {
    	color: #deb217;
	}
	.rate > input:checked + label:hover,
	.rate > input:checked + label:hover ~ label,
	.rate > input:checked ~ label:hover,
	.rate > input:checked ~ label:hover ~ label,
	.rate > label:hover ~ input:checked ~ label {
    	color: #c59b08;
	}
</style>
@extends('layouts.client.layout.master')
@section('titile','Product')
@section('content')
	<!-- Breacrumb Section Begin -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text">
						<a href=""><i class="fa fa-home"></i>Home</a>
						<a href="">Shop</a>
						<span>Detail</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breacrumb Section End -->

	<!-- Product Shop Section Begin -->
	<section class="product-shop spad page-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
                    <form action="shop">
                        <div class="filter-widget">
                            <h4 class="fw-title">Categories</h4>
                            <ul class="filter-catagories">
                                @foreach($categories as $category)
                                    <li><a href="shop/category/{{$category->name}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Brand</h4>
                            <div class="fw-brand-check">
                                @foreach($brands as $brand)
                                    <div class="bc-item">
                                        <label for="bc-{{$brand->id}}">
                                            {{$brand->name}}
                                            <input type="checkbox" {{(request("brand")[$brand->id] ?? '') == 'on' ? 'checked' : ''}}
                                            id="bc-{{$brand->id}}"
                                                   name="brand[{{$brand->id}}]"
                                                   onchange="this.form.submit();">
                                            <span class="checkmark "></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Price</h4>
                            <div class="filter-range-wrap">
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount" name="price_min">
                                        <input type="text" id="maxamount" name="price_max">
                                    </div>
                                </div>
                                <div class="price-range ui-slide ui-corner-all ui-slide-horizontal ui-widget ui-widget-content"
                                     data-min ="0" data-max="1000"
                                     data-min-value="{{str_replace('$', '', request('price_min'))}}"
                                     data-max-value="{{str_replace('$', '', request('price_max'))}}">
                                    <div class="ui-slide-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                            </div>
                            <button type="submit" class="filter-btn">Filter</button>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Tags</h4>
                            <div class="fw-tags">
                                <a href="#">Towel</a>
                                <a href="#">Shoes</a>
                                <a href="#">Coat</a>
                                <a href="#">Dresses</a>
                                <a href="#">Trousers</a>
                                <a href="#">Men's hats</a>
                                <a href="#">Blackpack</a>
                            </div>
                        </div>
                    </form>
				</div>
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-6">
							<div class="product-pic-zoom">
								<img class="product-big-img" src="front/img/products/{{$product->productImages[0]->path ?? ''}}" alt="">
								<div class="zoom-icon">
									<i class="fa fa-search-plus"></i>
								</div>
							</div>
							<div class="product-thumbs">
								<div class="product-thumbs-track ps-slider owl-carousel">
									@foreach($product->productImages as $productImage)
										<div class="pt active" data-imgbigurl="front/img/products/{{$productImage->path}}">
											<img src="front/img/products/{{$productImage->path}}" alt="">
										</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="product-details">
								<div class="pd-title">
									<span>{{$product->tag}}</span>
									<h3>{{$product->name}}</h3>
									<a href="#" class="heart-icon">
										<i class="icon_heart_alt"></i>
									</a>
								</div>
								<div class="pd-rating">
									@for($i = 1; $i<=5; $i++)
										@if($i <= $product->avgRating)
											<i class="fa fa-star"></i>
										@else
											<i class="fa fa-star-o"></i>
										@endif
									@endfor
									<span>{{count($product->productComments)}}</span>
								</div>
								<div class="pd-desc">
									<p>{{$product->description}}</p>
									@if($product->discount != null)
									<h4>${{$product->discount}} <span>${{$product->price}}</span></h4>
									@else
									<h4>${{$product->price}}</h4>
									@endif
								</div>
								<div class="pd-color">
									<h6>Color</h6>
									<div class="pd-color-choose">
										@foreach(array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor)
										<div class="cc-item">
											<input type="radio" id="cc-{{$productColor}}">
											<label for="cc-{{$productColor}}" class="cc-{{$productColor}}"></label>
										</div>
										@endforeach
									</div>
								</div>
								<div class="pd-size-choose">
									@foreach(array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize)
									<div class="sc-item">
										<input type="radio" id="sm-{{$productSize}}">
										<label for="sm-{{$productSize}}">{{$productSize}}</label>
									</div>
									@endforeach
								</div>
								<div class="quantity">
									<a href="javascript:addCart({{$product->id}})" class="primary-btn pd-cart">Add To Cart</a>
								</div>
								<ul class="pd-tags">
									<li><span>CATEGORIES</span>: {{$product->productCategory->name}}</li>
									<li><span>TAGS</span>: {{$product->tag}}</li>
								</ul>
								<div class="pd-share">
									<div class="p-code">Sku : {{$product->sku}}</div>
									<div class="pd-social">
										<a href="#"><i class="ti-facebook"></i></a>
										<a href="#"><i class="ti-twitter-alt"></i></a>
										<a href="#"><i class="ti-linkedin"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="product-tab">
						<div class="tab-item">
							<ul class="nav" role="tablist">
								<li><a class="active" href="#tab1" data-toggle="tab" role="tab">Customer Reviews ({{count($product->productComments)}})</a></li>
								<li><a href="#tab2" data-toggle="tab" role="tab">SPECIFICATIONS</a></li>
								<li><a href="#tab3" data-toggle="tab" role="tab">DESCRIPTION</a></li>
							</ul>
						</div>
						<div class="tab-item-content">
							<div class="tab-content">

							<div class="tab-pane fade-in active" id="tab-3" role="tabpannel">
								<div class="customer-review-option">
									<h4>Comments</h4>
								<div class="comment-option">
									@foreach($product->productComments as $productComment)
									<div class="co-item">
										<div class="avatar-pic">
											<img src="front/img/user/{{$productComment->user->avatar ?? 'default-avatar.jpg'}}" alt="">
										</div>
										<div class="avatar-text">
											<div class="at-rating">
												@for($i = 1; $i<=5; $i++)
													@if($i <= $productComment->rating)
														<i class="fa fa-star"></i>
													@else
														<i class="fa fa-star-o"></i>
													@endif
												@endfor
											</div>
											<h5>{{$productComment->name}} <span>{{date('M d, Y', strtotime($productComment->created_at))}}</span></h5>
											<div class="at-reply">{{$productComment->messages}}</div>
										</div>
									</div>
									@endforeach
								</div>

								<div class="leave-comment">
									<h4>Leave A Comment</h4>
									<form action="" method="post" class="comment-form">
										@csrf
										<input type="hidden" name="product_id" value="{{$product->id}}">
										<input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
										<div class="row">
											<div class="col-lg-6">
												<input type="text" placeholder="Name" name="name" value="{{Auth::user()->name ?? ''}}">
											</div>
											<div class="col-lg-6">
												<input type="text" placeholder="Email" name="email" value="{{Auth::user()->email ?? ''}}">
											</div>
											<div class="col-lg-12">
												<textarea placeholder="Messages" name="messages"></textarea>
												<div class="personal-rating">
												    <h6>Your Rating</h6>
												    <div class="rate">
												        <input type="radio" id="star5" name="rating" value="5" />
												        <label for="star5" title="text">5 stars</label>
												        <input type="radio" id="star4" name="rating" value="4" />
												        <label for="star4" title="text">4 stars</label>
												        <input type="radio" id="star3" name="rating" value="3" />
												        <label for="star3" title="text">3 stars</label>
												        <input type="radio" id="star2" name="rating" value="2" />
												        <label for="star2" title="text">2 stars</label>
												        <input type="radio" id="star1" name="rating" value="1" />
												        <label for="star1" title="text">1 star</label>
												    </div>
												</div>
												<button type="submit" class="site-btn">Send message</button>
											</div>
										</div>
									</form>
								</div>
								</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Product Shop Section End -->

	<!-- Related Products Section Begin -->
	<div class="related-products spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($relatedProducts as $product)
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
								<div class="pi-pic">
									<img src="front/img/products/{{$product->productImages[0]->path ?? ''}}" alt="">
									@if($product->discount != null)
									<div class="sale pp-sale">Sale</div>
									@endif
									<div class="icon">
										<i class="icon_heart_alt"></i>
									</div>
									<ul>
										<li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
										<li class="quick-view"><a href="{{$product->id}}">+ Quick View</a></li>
										<li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
									</ul>
								</div>
								<div class="pi-text">
									<div class="catagory-name">{{$product->tag}}</div>
									<a href="product/{{$product->id}}">
										<h5>{{$product->name}}</h5>
									</a>
									<div class="product-price">
										@if($product->discount != null)
										$ {{$product->discount}}
										<span>$ {{$product->price}}</span>
										@else
										<span>${{$product->price}}</span>
										@endif
									</div>
								</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- Related Products Section End -->

@endsection
