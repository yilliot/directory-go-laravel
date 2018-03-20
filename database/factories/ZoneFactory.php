<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Zone::class, function (Faker $faker) {
    $level = \App\Models\Level::find(rand(1,21));
    return [
        'level_id' => $level->id,
        'block_id' => $level->block_id,
        'zone_category_id' => rand(1, 3),
        'name' => $faker->name,
        'name_display' => $faker->name,
        'bg_colour' => $faker->randomElement([
            '#d6d7d9',
            '#91cdc6',
            '#d4441f',
            '#3f78be',
            '#ffc727',
            '#01937c',
        ]),
        'text_colour' => $faker->randomElement(['#FFF', '#000']),
        'text_size' => rand(12, 18) . 'px',
        'area_json' => '[]',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
    ];
});