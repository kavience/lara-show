<?php

namespace App;


class Fan extends BaseModel
{
    protected $fillable = ['fan_id', 'star_id'];

    //粉丝用户
    public function fanUser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    //被关注用户
    public function starUser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }
    
}
