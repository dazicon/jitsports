<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        //except指定不使用中间件过滤的动作
        $this->middleware('auth',[
            'except' => ['show','create','store']
        ]);

        //只让未登录用户访问注册页面
        $this->middleware('guest',[
            'only' => ['create']  
        ]);
    }

    /**
     * 进入注册页面
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * 显示用户个人主页
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 用户注册
     * validate验证
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:50',
           'email' => 'required|email|unique:users|max:255',
           'stu_id' => 'required|numeric|min:10',
           'class' => 'required|max:100',
           'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'stu_id' => $request->stu_id,
            'class' => $request->class,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
    }

    /**
     * 进入编辑用户页面
     */
    public function edit(User $user)
    {
        //授权验证
        $this->authorize('update','$user');
        return view('users.edit',compact('user'));
    }

    /**
     * 更新提交的用户信息
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:50',
           'stu_id' => 'required|numeric|min:10',
           'class' => 'required|max:100',
           //required 规则换成 nullable，当用户提供空白密码时也会通过验证,不必要改密码
           'password' => 'nullable|confirmed|min:6'
        ]);

        //授权验证
        $this->authorize('update','$user');

        $data = [];
        $data['name'] = $request->name;
        $date['stu_id'] = $request->stu_id;
        $date['class'] = $request->class;

        //对传入的 password 进行判断，当其值不为空时才将其赋值给 data，避免将空白密码保存到数据库中。
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show',$user->id);
    }
}
