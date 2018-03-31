<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-30
 * Time: 下午3:40
 */

namespace App\Http\Controllers\Admin;


use App\Article;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        $articles = Article::withoutGlobalScope('avaiable')->where('status', 0)->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.article.index', compact('articles'));
    }

    /**
     * 操作
     */
    public function status(Article $article)
    {
        $this->validate(request(), [
            'status' => 'required|in:-1,1',
        ]);

        $article->status = request('status');
        $article->save();

        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
