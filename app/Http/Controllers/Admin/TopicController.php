<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-31
 * Time: 上午10:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{

    /**
     * 专题首页
     */
    public function index()
    {
        $topics = Topic::paginate(10);

        return view('admin.topic.index', compact('topics'));
    }

    /**
     * 专题创建页面
     */
    public function create()
    {

        return view('admin.topic.create');
    }

    /**
     * 专题创建逻辑
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|max:10'
        ]);

        Topic::create(['name' => request('name')]);

        return redirect('/admin/topics');
    }

    /**
     * 专题删除逻辑
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return [
            'error' => 0,
            'msg' => '删除成功'
        ];
    }
}
