<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id'=> random_int(31, 38),
        'type_id'=> random_int(46, 53),
        'trade_name'=> $faker->tradeName,
        'comercial_activity'=> $faker->comercialActivity,
        'state_id'=>1,
    ];
});
