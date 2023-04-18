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
                        <span>My Order Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breacrumb Section End -->

    <!-- Checkout Section Begin -->
    <div class="checkout-section spad">
        <div class="container">
            <form action="#" class="checkout-form">
                <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="#" class="content-btn">
                                    Order ID:
                                    <b>#{{$order->id}}</b>
                                </a>
                            </div>
                            <h4>Billing Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="fir">First Name <span>*</span></label>
                                    <input type="text" id="fir" name="first_name" value="{{$order->first_name}}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="last">Last Name <span>*</span></label>
                                    <input type="text" id="last" name="last_name" value="{{$order->last_name}}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="phone">Phone <span>*</span></label>
                                    <input type="text" id="phone" name="phone" value="{{$order->phone}}">
                                </div>
                                <div class="col-lg-6">
                                    <label for="email">Email <span>*</span></label>
                                    <input type="text" id="email" name="email" value="{{$order->email}}">
                                </div>
                                <div class="col-lg-12">
                                    <label for="adress">Adress <span>*</span></label>
                                    <input type="text" id="adress" name="adress"value="{{$order->adress}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout-content">
                                <a href="#" class="content-btn">
                                    Status:
                                    <b>{{\App\Utilities\Constant::$order_status[$order->status]}}</b>
                                </a>
                            </div>
                            <div class="place-order">
                                <h4>Your order</h4>
                                <div class="order-total">
                                    <ul class="order-table">
                                        <li>Product <span>Total</span></li>
                                        @foreach($order->orderDetails as $orderDetail)
                                            <li class="fw-normal">{{$orderDetail->product->name}} x {{$orderDetail->qty}} <span>${{$orderDetail->total}}</span></li>
                                        @endforeach
                                        <li class="total-price">
                                            Total
                                            <span>${{ array_sum(array_column($order->orderDetails->toArray(),'total'))}}</span>
                                        </li>
                                    </ul>
                                    <div class="payment-check">
                                        <div class="pc-item">
                                            <label for="pc-check">
                                                Thanh toán khi nhận hàng
                                                <input type="radio" id="pc-check" name="payment_type" value="pay_later"
                                                {{ $order->payment_type == 'pay_later' ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="pc-item">
                                            <label for="pc-paypal">
                                                Thanh toán online
                                                <input type="radio" id="pc-paypal" name="payment_type" value="online_payment"
                                                    {{ $order->payment_type == 'online_payment' ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Section End -->
@endsection
