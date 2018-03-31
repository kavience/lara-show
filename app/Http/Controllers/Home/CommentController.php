<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-26
 * Time: 下午1:14
 */

namespace App\Http\Controllers\Home;


use App\Article;
use App\Comment;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    /**
     * 提交评论逻辑
     */
    public function submitComment(Article $article)
    {
        //验证
        $this->validate(request(), [
            'content'  =>    'required',
        ]);

        //逻辑
        $comment = new  Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');

        $article->comments()->save($comment);

        //渲染
        return back();
    }
}
