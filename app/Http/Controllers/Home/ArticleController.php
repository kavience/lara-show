<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-24
 * Time: 下午10:39
 */

namespace App\Http\Controllers\Home;


use App\Article;
use App\Http\Controllers\Controller;
use App\Zan;

class ArticleController extends Controller
{
    public function index()
    {

    }

    /**
     * 文章详情页
     */
    public function show(Article $article)
    {
        $comments = $article->comments()->paginate(5);

        return view('home.article.detail', compact('article', 'comments'));
    }

    /**
     * 文章创建页
     */
    public function create()
    {
        if (\Auth::guest()) {
            return redirect('/login');
        }

        return view('home.article.create');
    }

    /**
     * 文章创建逻辑
     */
    public function store()
    {
        $this->validate(request(), [
            'title'    =>    'required|max:100',
            'content'  =>    'required',
        ]);

        $data = request(['title', 'content']);
        $data['user_id'] = \Auth::id();

        Article::create($data);

        return redirect('/');
    }

    /**
     * 文章编辑页面
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('home.article.update', compact('article'));
    }
    
    /**
     * 文章编辑逻辑
     */
    public function update(Article $article)
    {
        $this->authorize('update', $article);

        $this->validate(request(), [
            'title'    =>    'required|max:100',
            'content'  =>    'required',
        ]);

        $article->title = request('title');
        $article->content = request('content');

        $article->save();

        return redirect("/article/{$article->id}");
    }
    
    /**
     * 删除文章逻辑
     */
    public function destroy(Article $article)
    {
        $this->authorize('update', $article);

        $article->delete();

        return redirect('/');

    }

    /**
     * 给赞
     */
    public function zan(Article $article)
    {
        $data = [
            'user_id'    =>    \Auth::id(),
            'article_id' =>    $article->id,
        ];

        Zan::firstOrCreate($data);

        return back();
    }

    /**
     * 取消赞
     */
    public function unzan(Article $article)
    {
        $article->zan(\Auth::id())->delete();

        return back();
    }


}
