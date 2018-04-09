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
            'except' => ['show','create','store','index']
        ]);

        //只让未登录用户访问注册页面
        $this->middleware('guest',[
            'only' => ['create']
        ]);
    }

    /**
     * 显示所有用户
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
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
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        $statuses = $user->statuses()
                         ->orderBy('created_at','desc')
                         ->paginate(10);
        return view('users.show', compact('user', 'statuses'));
    }

    public function showComment(User $user)
    {
        $comments = $user->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('users.showComment', compact('user', 'comments'));
    }

    /**
     * 用户注册
     * validate验证
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:50',
           'email' => 'required|email|unique:users|max:255',
           'stu_id' => 'required|numeric|min:10',
           'klass' => 'required|max:100',
           'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'stu_id' => $request->stu_id,
            'klass' => $request->klass,
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
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    /**
     * 更新提交的用户信息
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request,[
           'name' => 'required|max:50',
           //'stu_id' => 'required|numeric|min:10',
           'klass' => 'required|max:100',
           //required 规则换成 nullable，当用户提供空白密码时也会通过验证,不必要改密码
           'password' => 'nullable|confirmed|min:6'
        ]);

        //授权验证
        $this->authorize('update',$user);

        $data = [];
        $data['name'] = $request->name;
        //$date['stu_id'] = $request->stu_id;
        $date['klass'] = $request->klass;

        //对传入的 password 进行判断，当其值不为空时才将其赋值给 data，避免将空白密码保存到数据库中。
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show',$user->id);
    }

    /**
     * 删除用户
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户');
        return back();
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(20);
        $title = '粉丝';
        return view('users.show_follow',compact('users','title'));
    }

    public function followings(User $user)
    {
        $users = $user->followings()->paginate(20);
        $title = '关注的人';
        return view('users.show_follow',compact('users','title'));
    }


}
