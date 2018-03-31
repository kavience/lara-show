<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-25
 * Time: 下午12:52
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;
use App\User;

class RegisterController extends Controller
{
    /**
     * 注册页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home.register.index');
    }

    /**
     * 注册行为
     */
    public function doRegister()
    {
        //验证
        $this->validate(request(), [
            'nickname'    =>    'required|min:3|max:15|unique:users,nickname',
            'username'    =>    'required|min:6|max:15|unique:users,username',
            'password'    =>    'required|min:6|max:16|confirmed',
        ]);

        //逻辑
        $data = [
            'nickname'    =>    request('nickname'),
            'username'    =>    request('username'),
            'password'    =>    bcrypt(request('password')),
        ];
        User::create($data);

        //渲染
        return redirect('/login');
    }
}
