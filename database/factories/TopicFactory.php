<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-25
 * Time: 下午12:29
 */

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'name'=>      $faker->sentence(1),
        'created_at'    =>      $faker->dateTimeThisMonth(),
        'updated_at'    =>      $faker->dateTimeThisMonth(),
    ];
});
