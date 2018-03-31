<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-25
 * Time: 下午12:29
 */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'username'      =>      $faker->userName,
        'nickname'      =>      $faker->name(),
        'password'      =>      bcrypt('123456'),
        'remember_token'=>      0,
        'created_at'    =>      $faker->dateTimeThisMonth(),
        'updated_at'    =>      $faker->dateTimeThisMonth(),
    ];
});
