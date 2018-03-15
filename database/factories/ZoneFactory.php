<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Zone::class, function (Faker $faker) {
    $level = \App\Models\Level::find(rand(1,36));
    return [
        'level_id' => $level->id,
        'block_id' => $level->block_id,
        'zone_category_id' => rand(1, 3),
        'name' => $faker->name,
        'name_display' => $faker->name,
        'bg_colour' => '#TODO_ENUM_RANDOM',
        'text_colour' => '#TODO_ENUM_RANDOM',
        'text_size' => rand(12, 18) . 'px',
        'area_json' => '[{x:1,y:3}]',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
    ];
});