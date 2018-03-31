<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-24
 * Time: 下午10:03
 */

namespace App\Http\Controllers\Home;


use App\User;

class UserController
{
    /**
     * 个人中心详情页
     */
    public function show(User $user)
    {
        //用户
        $user = User::withCount(['stars', 'fans', 'articles'])->find($user->id);

        //用户前十篇文章
        $articles = $user->articles()->orderBy('created_at', 'desc')->take(10)->get();

        //关注的用户的  关注/粉丝/文章数
        $stars = $user->stars();
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'articles'])->get();

        //粉丝的  关注/粉丝/文章数
        $fans = $user->fans();
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'articles'])->get();


        return view('home.center.index', compact('user', 'articles', 'stars', 'fans', 'fusers', 'susers'));
    }
   
    /**
     *关注用户
     */
    public function fan(User $user)
    {
        \Auth::user()->doFan($user->id);
        
        return [
            'error' =>0,
            'msg' =>'',
        ];
    }

    /**
     *取消关注
     */
    public function unfan(User $user)
    {
        \Auth::user()->doUnFan($user->id);

        return [
            'error' =>0,
            'msg' =>'',
        ];
    }

}   
