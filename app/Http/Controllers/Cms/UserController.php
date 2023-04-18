<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @var Application|mixed
     */
    private $userService;

    /**
     * Display a listing of the resource.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->searchAndPaginate('name',$request->get('search'));
        return view('layouts.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.users.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('password') != null) {
            if($request->get('password') != $request->get('password_confirmation')) {
                return back()->with('notification', 'ERROR: Confirm password does not match!!');
            }
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->get('password'));

        if($request->hasFile('image')) {
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/img/user');
        }
        $this->userService->create($data);
        return redirect('admin/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('layouts.admin.users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        if($request->get('password') != null) {
            if($request->get('password') != $request->get('password_confirmation')) {
                return back()->with('notification', 'ERROR: Confirm password does not match!!');
            }
            $data['password'] = bcrypt($request->get('password'));
        }else {
            unset($data['password']);
        }

        if($request->hasFile('image')) {
            $data['avatar'] = Common::uploadFile($request->file('image'),'front/img/user');

            $file_image_old = $request->get('image_old');
            if($file_image_old != '') {
                unlink('front/img/user/'.$file_image_old);
            }
        }
        $this->userService->update($data,$user->id);
        return redirect('admin/users/'.$user->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user->id);

        $file_name = $user->avatar;
        if($file_name != '') {
            unlink('front/img/user/'.$file_name);
        }

        return redirect('admin/users');
    }
}
