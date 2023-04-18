<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use App\Services\Order\OrderServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * @var Application|mixed
     */
    private $userService;

    /**
     * @var Application|mixed
     */
    private $orderService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userService, OrderServiceInterface $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;

    }



    /**
     * Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('layouts.client.page.login');
    }

    /**
     * Check login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::role_client,
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('');
        }else
        {
            return back()->with('notification','ERROR: Email or password is wrong!');
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('');
    }

    /**
     * Register
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('layouts.client.page.register');
    }

    /**
     * Create new account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
//        $user = $this->userService->findByColumn(['email'=>$request->email])->pluck('email')->first();
//        if($user != null ){
//            return back()->with('notification','ERROR: Email already exists!!');
//        }
        if($request->password != $request->password_confirmation)
        {
            return back()->with('notification','ERROR: Confirm password does not match!!');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::not_activated,
            'phone' => $request->phone,
            'adress' => $request->adress,
        ];
        $data['token'] = Str::random(10);
        $user = $this->userService->create($data);
        $email_to = $user->email;

        Mail::send('layouts.client.page.active_email',
            compact('user'),
            function ($message) use ($email_to) {
                $message->from('kinganhtu0902@gmail.com','HanavyShop');
                $message->to($email_to, $email_to);
                $message->subject('Register Notification');
            });
        return redirect('/account/login')->with('notification','Register Success!! Please check your email.');
    }

    public function actived($id, $token)
    {
        $user = $this->userService->find($id);
        if($user->token == $token) {
            $user->update(['level'=>Constant::role_client , 'token'=>null]);
            return  redirect('/account/login')->with('notification','Active Success!! Please login.');
        }else {
            return  redirect('/account/login')->with('notification','Invalid verification code!!');
        }
    }

    public function myOrder()
    {
        $orders = $this->orderService->getOrderByUserId(Auth::id());
        return view('layouts.client.page.my_order', compact('orders'));
    }

    public function myOrderDetail($id)
    {
        $order = $this->orderService->find($id);

        return view('layouts.client.page.my_order_detail', compact('order'));
    }

}
