<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-29
 * Time: 下午10:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index.index');
    }

}
