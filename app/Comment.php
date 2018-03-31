<?php

namespace App;


class Comment extends BaseModel
{
    protected $fillable = ['article_id', 'user_id', 'content'];

    /**
     * 评论关联文章
     */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    /**
     * 评论关联用户
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
