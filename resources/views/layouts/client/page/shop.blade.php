@extends('layouts.client.layout.master')
@section('titile','Shop')
@section('content')
	<!-- Breacrumb Section Begin -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text">
						<a href="/"><i class="fa fa-home"></i>Home</a>
						<span>Shop</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breacrumb Section End -->

	<!-- Product Shop Section Begin -->
	<section class="product-shop spad">
		<div class="container">
			<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
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
			<div class="col-lg-9 order-1 order-lg-2">
				<div class="product-show-option">
					<div class="row">
							<div class="col-lg-7 col-md-7">
                                <form action="">
                                    <div class="select-option">
                                        <select class="sorting" onchange="this.form.submit();" name="sort_by" >
                                            <option {{request('sort_by') == 'latest' ? 'selected' : ''}} value="latest">Sorting: Latest</option>
                                            <option {{request('sort_by') == 'oldest' ? 'selected' : ''}} value="oldest">Sorting: Oldest</option>
                                            <option {{request('sort_by') == 'name-ascending' ? 'selected' : ''}} value="name-ascending">Sorting: Name A-Z</option>
                                            <option {{request('sort_by') == 'name-descending' ? 'selected' : ''}} value="name-descending">Sorting: Name Z-A</option>
                                            <option {{request('sort_by') == 'price-ascending' ? 'selected' : ''}} value="price-ascending">Sorting: Price Ascending</option>
                                            <option {{request('sort_by') == 'price-descending' ? 'selected' : ''}} value="price-descending">Sorting: Price decrease</option>
                                        </select>
                                        <select class="p-show" onchange="this.form.submit();" name="show">
                                            <option {{request('show') == '9' ? 'selected' : ''}} value="9">Show: 9</option>
                                            <option {{request('show') == '15' ? 'selected' : ''}} value="15">Show: 15</option>
                                        </select>
                                    </div>
                                </form>

							</div>
					</div>
				</div>
				<div class="product-list">
					<div class="row">
                        @foreach($products as $product)
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<img src="front/img/products/{{$product->productImages[0]->path ?? ''}}" alt="">
                                    @if($product ->discount != null)
									    <div class="sale pp-sale">Sale</div>
                                    @endif
									<div class="icon">
										<i class="icon_heart_alt"></i>
									</div>
									<ul>
										<li class="w-icon active"><a href="javascript:addCart({{$product->id}})"><i class="icon_bag_alt"></i></a></li>
										<li class="quick-view"><a href="/shop/product/{{$product->id}}">+ Quick View</a></li>
										<li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
									</ul>
								</div>
								<div class="pi-text">
									<div class="catagory-name">{{$product->tag}}</div>
									<a href="/shop/product/{{$product->id}}">
										<h5>{{$product->name}}</h5>
									</a>
									<div class="product-price">
                                        @if($product->discount != null)
										${{$product->discount}}
										    <span>{{$product->price}}</span>
                                        @else
                                            ${{$product->discount}}
                                        @endif
									</div>
								</div>
							</div>
						</div>
                        @endforeach
					</div>
				</div>
				{{$products->links()}}
			</div>
		</div>
        </div>

	</section>
	<!-- Product Shop Section End -->

@endsection
