<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-29
 * Time: 下午10:04
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页面
     */
    public function index()
    {
        return view('admin.login.index');
    }

    /**
     * 登录逻辑
     */
    public function doLogin()
    {
        $user = request(['username', 'password']);
        if (\Auth::guard('admin')->attempt($user)) {
            return redirect('/admin');
        }

        return back()->withErrors('用户名密码不匹配');
    }

    /**
     * 登出操作
     */
    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
