<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $this->call(ArticleTableSeeder::class);

        $this->call(TopicTableSeeder::class);

        $this->call(AdminPermissionsTableSeeder::class);

        $this->call(AdminPermissionRoleTableSeeder::class);

        $this->call(AdminRolesTableSeeder::class);

        $this->call(AdminRoleUserTableSeeder::class);

        $this->call(AdminUsersTableSeeder::class);
    }
}
