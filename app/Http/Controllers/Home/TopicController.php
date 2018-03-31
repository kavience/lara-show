<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-29
 * Time: 下午5:28
 */

namespace App\Http\Controllers\Home;


use App\Article;
use App\ArticleTopic;
use App\Http\Controllers\Controller;
use App\Topic;

class TopicController extends Controller
{
    /**
     * 专题详情
     */
    public function show(Topic $topic)
    {
        //带文章数的专题
        $topic = Topic::withCount('articleTopics')->find($topic->id);

        //专题的文章列表，显示最新的10个
        $articles = $topic->articles()->orderBy('created_at', 'desc')->take(10)->get();

        //属于我的文章但未投稿
        $myArticles = Article::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('home.topic.index', compact('topic', 'articles', 'myArticles'));
    }

    /**
     * 专题投稿
     */
    public function submit(Topic $topic)
    {
        $this->validate(request(), [
           'post_ids' => 'required|array'
        ]);

        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $article_id) {
            ArticleTopic::firstOrCreate(['topic_id' => $topic_id, 'article_id' => $article_id]);
        }

        return back();
    }
}
