<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-25
 * Time: 下午12:55
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home.login.index');
    }

    /**
     * 登录操作
     */
    public function doLogin()
    {
        //验证
        $this->validate(request(), [
            'username'    =>    'required|min:6|max:15',
            'password'    =>    'required|min:6|max:16',
            'is_remember' =>    'integer',
        ]);

        //逻辑
        $data = request(['username','password']);
        $is_remember = boolval(request('is_remember'));
        if (\Auth::attempt($data, $is_remember)) {

            return redirect('/');
        }

        //渲染
        return back()->withErrors('账号密码有误');
    }

    public function logOut()
    {
        \Auth::logout();

        return redirect('/login');
    }
}
