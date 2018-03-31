<?php

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_roles')->insert([
            'name' => '超级管理员',
            'description' => '拥有所有权限',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_roles')->insert([
            'name' => '文章管理员',
            'description' => '拥有文章管理权限',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_roles')->insert([
            'name' => '专题管理员',
            'description' => '拥有专题管理权限',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        DB::table('admin_roles')->insert([
            'name' => '通知管理员',
            'description' => '拥有通知管理权限',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
    }
}
