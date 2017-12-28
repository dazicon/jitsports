<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;

class UsersController extends Controller
{
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
}
