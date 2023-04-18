@extends('layouts.admin.layout.master')
@section('title', 'Order')
@section('content')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>
                        Order
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body display_data">

                        <div class="table-responsive">
                            <h2 class="text-center">Products list</h2>
                            <hr>
                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderDetails as $orderDetail )
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img style="height: 60px;"
                                                             data-toggle="tooltip" title="Image"
                                                             data-placement="bottom"
                                                             src="front/img/products/{{$orderDetail->product->productImages[0]->path}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{$orderDetail->product->name}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{$orderDetail->qty}}
                                    </td>
                                    <td class="text-center">${{$orderDetail->amount}}</td>
                                    <td class="text-center">
                                        ${{$orderDetail->total}}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>



                        <h2 class="text-center mt-5">Order info</h2>
                        <hr>
                        <form action="admin/orders/{{$order->id}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Full Name
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->first_name.' '.$order->last_name}}</p>
                                <input type="hidden" value="{{$order->first_name}}" name="first_name">
                                <input type="hidden" value="{{$order->last_name}}" name="last_name">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->email}}</p>
                                <input type="hidden" value="{{$order->email}}" name="email">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">Phone</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->phone}}</p>
                                <input type="hidden" value="{{$order->phone}}" name="phone">
                            </div>
                        </div>


                        <div class="position-relative row form-group">
                            <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                Address</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->adress}}</p>
                                <input type="hidden" value="{{$order->adress}}" name="adress">
                            </div>
                        </div>


                        <div class="position-relative row form-group">
                            <label for="payment_type" class="col-md-3 text-md-right col-form-label">Payment Type</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->payment_type}}</p>
                                <input type="hidden" value="{{$order->payment_type}}" name="payment_type">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id"
                                   class="col-md-3 text-md-right col-form-label">Status</label>
                            <div class="col-md-6 col-xl-2">
                                <select required name="status" id="status" class="form-control" onchange="this.form.submit();">
                                    @foreach(\App\Utilities\Constant::$order_status as $key => $value)
                                        <option
                                            @if ($order->status == $key)
                                                {{"selected"}}
                                            @endif
                                            value="{{$key}}">
                                            {{$value}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description"
                                   class="col-md-3 text-md-right col-form-label">Description</label>
                            <div class="col-md-9 col-xl-8">
                                <p>{{$order->description}}</p>
                            </div>
                            <input type="hidden" value="{{$order->description}}" name="description">
                        </div>
                            <div class="position-relative row form-group mb-1">
                                <div class="col-md-9 col-xl-8 offset-md-3">
                                    <button type="submit"
                                            class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                        <span>Ok</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
