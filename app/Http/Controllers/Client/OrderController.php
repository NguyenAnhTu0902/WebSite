<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailService;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderServiceInterface $orderService, OrderDetailService $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;

    }

    /**
     * @var Application|mixed
     */
    private $orderService;

    /**
     * @var Application|mixed
     */
    private $orderDetailService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('layouts.client.page.order', compact('carts','total','subtotal'));
    }

    /**
     * Add new product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addOrder(Request $request)
    {
        //Thêm đơn hàng
        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $order = $this->orderService->create($data);

        //Thêm chi tiết đơn hàng
        $carts = Cart::content();
        foreach($carts as  $cart)
        {
            $data = [
                'order_id' => $order->id ,
                'product_id' => $cart->id ,
                'qty' => $cart->qty ,
                'amount' => $cart->price ,
                'total' => $cart->qty * $cart->price ,
            ];
            $this->orderDetailService->create($data);
        }
        if($request->payment_type == 'pay_later') {
            //Gửi email
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendMail($order,$total,$subtotal);

            //Xóa giỏ hàng
            Cart::destroy();

            //Trả về thông báo
            return redirect('/order/result')->with('notification','Bạn đã đặt hàng thành công!! Vui lòng kiểm tra email!!');
        }

        if($request->payment_type == 'online_payment') {
            //Lấy URL thanh toán VNpay
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id, //ID của đơn hàng
                'vnp_OrderInfo' => 'Mo ta don hang',
                'vnp_Amount' => Cart::total(0, '', '')*23070,
            ]);

            //Chuyển hướng URL lấy được
            return redirect()->to($data_url);
        }
    }
    /**
     * Online Payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function vnPayCheck(Request $request)
    {
        //Lấy data từ URL(do VnPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');
        //Kiểm tra data, xem kết quả giao dịch trả về từ VNpay có hợp lệ không
        if($vnp_ResponseCode != null)
        {
            if ($vnp_ResponseCode == 00) {
                //Cập nhật trạng thái
                $this->orderService->update([
                   'status' => Constant::order_status_Paid,
                ], $vnp_TxnRef);
                //Gửi email
                $order = $this->orderService->find($vnp_TxnRef);
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendMail($order,$total,$subtotal);

                //Xóa giỏ hàng
                Cart::destroy();

                //Trả về thông báo
                return redirect('/order/result')->with('notification','Bạn đã đặt hàng thành công!! Vui lòng kiểm tra email!!');
            }else
            {
                //Xóa đơn hàng
                $this->orderService->delete($vnp_TxnRef);
                //Thông báo lỗi
                return redirect('order/result')->with('notification','ERROR: Thanh toán không thành công!!');
            }
        }
    }

    /**
     * Result to view
     *
     * @return \Illuminate\Http\Response
     */
    public function result()
    {
        $notification = session('notification');
        return view('layouts.client.page.result', compact('notification'));
    }

    /**
     * Send email check to order
     *
     * @param $order
     * @param $subtotal
     * @param $total
     */
    public function sendMail($order, $total, $subtotal)
    {
        $email_to = $order->email;

        Mail::send('layouts.client.page.email',
                compact('order','total','subtotal'),
                function ($message) use ($email_to) {
                    $message->from('kinganhtu0902@gmail.com','HanavyShop');
                    $message->to($email_to, $email_to);
                    $message->subject('Order Notification');
        });
    }
}
