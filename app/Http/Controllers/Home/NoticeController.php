<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-31
 * Time: 上午11:16
 */

namespace App\Http\Controllers\Home;


use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    /**
     * 前台通知列表
     */
    public function index()
    {
        if (\Auth::guest()) {
            return redirect('/login');
        }

        $user = \Auth::user();
        $notices = $user->notices;

        return view('home.notice.index', compact('notices'));
    }
}