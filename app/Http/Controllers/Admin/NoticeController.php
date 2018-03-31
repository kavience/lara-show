<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-31
 * Time: 上午10:48
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Jobs\SendMessage;
use App\Notice;

class NoticeController extends Controller
{
    /**
     * 通知首页
     */
    public function index()
    {
        $notices = Notice::all();

        return view('admin.notice.index', compact('notices'));
    }

    /**
     * 发布通知页面
     */
    public function create()
    {

        return view('admin.notice.create');
    }

    /**
     * 发布通知逻辑
     */
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|max:25',
            'content' => 'required',
        ]);

        $notice = Notice::create(request(['title', 'content']));

        //通知分发逻辑
        dispatch(new SendMessage($notice));

        return redirect('/admin/notices');
    }

}
