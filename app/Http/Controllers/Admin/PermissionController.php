<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-30
 * Time: 下午5:48
 */

namespace App\Http\Controllers\Admin;


use App\AdminPermission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * 权限列表页面
     */
    public function index()
    {
        $permissions = AdminPermission::paginate(10);

        return view('admin.system.permission.index', compact('permissions'));
    }
    
    /**
     * 权限创建页面
     */
    public function create()
    {

        return view('admin.system.permission.create');
    }
    
    /**
     * 创建权限的实际行为
     */
    public function store()
    {

        $this->validate(request(), [
            'name' => 'required|min:3|max:10',
            'description' => 'required|max:20'
        ]);

        AdminPermission::create(request(['name', 'description']));

        return redirect('/admin/permissions');
    }
}
