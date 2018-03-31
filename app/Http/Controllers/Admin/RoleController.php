<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-30
 * Time: 下午5:48
 */

namespace App\Http\Controllers\Admin;


use App\AdminPermission;
use App\AdminRole;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * 角色列表
     */
    public function index()
    {
        $roles = AdminRole::paginate(10);

        return view('admin.system.role.index', compact('roles'));
    }
    
    /**
     * 角色创建页面
     */
    public function create()
    {

        return view('admin.system.role.create');
    }
    
    /**
     * 角色创建逻辑
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3|max:10',
            'description' => 'required|max:20'
        ]);

        AdminRole::create(request(['name', 'description']));

        return redirect('/admin/roles');
    }
    
    /**
     * 角色和权限关系页面
     */
    public function permission(AdminRole $role)
    {
        //获取所有权限
        $permissions = AdminPermission::all();

        //获取当前角色的权限
        $myPermissions = $role->permissions;

        return view('admin.system.role.permission', compact('permissions', 'myPermissions', 'role'));
    }

    /**
     * 储存角色权限
     */
    public function storePermission(AdminRole $role)
    {
        $this->validate(request(), [
            'permissions' => 'required|array',
        ]);

        $permissions = AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;

        //要增加的权限
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $addPermission) {
            $role->grantPermission($addPermission);
        }

        //要删除的权限
        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $deletePermission) {
            $role->deletePermission($deletePermission);
        }

        return back();
    }
}
