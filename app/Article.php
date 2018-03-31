<?php

namespace App;


use Illuminate\Database\Eloquent\Builder;

class Article extends BaseModel
{
    protected $fillable = ['title', 'content', 'user_id'];

    /**
     * 关联用户
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * 关联评论
     */
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    /**
     *关联赞
     */
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }
    
    /**
     * 获取文章所有的赞
     */
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    /**
     * 属于某个作者的文章
     */
    public function scopeAuthorBy(\Illuminate\Database\Eloquent\Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    /**
     *文章有多个专题
     */
    public function articleTopics()
    {

        return $this->hasMany(ArticleTopic::class, 'article_id', 'id');
    }
    
    /**
     * 不属于某个专题的文章
     */
    public function scopeTopicNotBy(\Illuminate\Database\Eloquent\Builder $query, $topic_id)
    {
        return $query->doesntHave('articleTopics', 'and', function ($q) use($topic_id) {
            $q->where('topic_id', $topic_id);
        });
    }

    /**
     * 全局scope的方式
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('avaiable', function (Builder $builder) {
           $builder->whereIn('status', [0,1]);
        });
    }
}
