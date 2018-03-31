<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];

    /**
     * 专题的文章
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_topics', 'topic_id', 'article_id');
    }

    /**
     * 专题的文章数
     */
    public function articleTopics()
    {

        return $this->hasMany(ArticleTopic::class, 'topic_id', 'id');
    }
    
}
