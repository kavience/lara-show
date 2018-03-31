<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['nickname', 'username', 'password'];

    //用户的文章列表
    public function articles()
    {
        return $this->hasMany(\App\Article::class, 'user_id', 'id');
    }

    //关注我的
    public function fans()
    {
        return $this->hasMany(\App\Fan::class, 'star_id', 'id');
    }

    //我关注的
    public function stars()
    {
        return $this->hasMany(\App\Fan::class, 'fan_id', 'id');
    }

    //关注某人
    public function doFan($userId)
    {
        $fan = new \App\Fan();
        $fan->star_id = $userId;
        return $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($userId)
    {
        $fan = new \App\Fan();
        $fan->star_id = $userId;
        return $this->stars()->delete($fan);
    }

    /**
     * 当前用户是否被某人关注
     */
    public function hasFan($userId)
    {
        return $this->fans()->where('fan_id', $userId)->count();
    }

    /**
     * 当前用户是否关注了某人
     */
    public function hasStar($userId)
    {
        return $this->stars()->where('star_id', $userId)->count();
    }

    /**
     * 用户收到的通知
     */
    public function notices()
    {
        return $this->belongsToMany(Notice::class, 'user_notice', 'user_id', 'notice_id')
            ->orderBy('created_at', 'desc')->withPivot(['user_id', 'notice_id']);
    }
    
    /**
     * 给用户增加通知
     */
    public function addNotice($notice)
    {
        return $this->notices()->save($notice);
    }
}
