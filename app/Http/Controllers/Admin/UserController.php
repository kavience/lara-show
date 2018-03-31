<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-30
 * Time: 下午2:29
 */

namespace App\Http\Controllers\Admin;


use App\AdminRole;
use App\AdminUser;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 列表
     */
    public function index()
    {
        $users = AdminUser::paginate(10);

        return view('admin.system.user.index', compact('users'));
    }

    /**
     * 创建页面
     */
    public function create()
    {
        return view('admin.system.user.add');
    }

    /**
     * 创建逻辑
     */
    public function store()
    {
        $this->validate(request(), [
            'nickname' => 'required|min:3|max:10',
            'username' => 'required|min:3|max:10',
            'password' => 'required|min:3|max:16',
        ]);

        $data['nickname'] = request('nickname');
        $data['username'] = request('username');
        $data['password'] = bcrypt(request('password'));
        AdminUser::create($data);

        return back();
    }

    /**
     * 用户角色页面
     */
    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;

        return view('admin.system.user.role', compact('roles', 'myRoles', 'user'));
    }
    
    /**
     * 用户角色储存
     */
    public function storeRole(AdminUser $user)
    {
        $this->validate(request(), [
            'roles' => 'required|array'
        ]);

        $roles = AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;

        //要增加的角色
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $addRole) {
            $user->assignRole($addRole);
        }

        //要删除的角色
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $deleteRole) {
            $user->deleteRole($deleteRole);
        }

        return back();
    }
}
