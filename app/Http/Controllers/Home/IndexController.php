<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-24
 * Time: 下午8:27
 */

namespace App\Http\Controllers\Home;


use App\Article;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * 网站首页
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->withCount('comments', 'zans')->paginate(5);

        return view('home.index.index', compact('articles', 'auth'));
    }

}
