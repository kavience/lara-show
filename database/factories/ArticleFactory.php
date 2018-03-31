<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-25
 * Time: 下午12:35
 */
use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {

    return [
        'title'         =>      $faker->sentence(5),
        'content'       =>      $faker->sentence(500),
        'user_id'       =>      1,
        'topic_id'      =>      1,
        'created_at'    =>      $faker->dateTimeThisMonth(),
        'updated_at'    =>      $faker->dateTimeThisMonth(),
    ];
});