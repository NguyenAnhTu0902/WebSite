<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomePageController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderServiceInterface $orderService, UserServiceInterface $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    /**
     * @var Application|mixed
     */
    private $orderService;

    /**
     * @var Application|mixed
     */
    private $userService;


    public function getDashboard(){
        $total = [
            'users' => $this->userService->all()->count(),
            'orders' => $this->orderService->all()->count()
        ];

        return view('layouts.adminLTE.home.app', compact('total'));
    }

    public function getLogin()
    {
        return view('layouts.admin.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => [Constant::role_admin],
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('admin');
        }else
        {
            return back()->with('notification','ERROR: Email or password is wrong!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('admin/login');
    }

}
