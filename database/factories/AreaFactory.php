<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Area::class, function (Faker $faker) {
    $level = \App\Models\Level::find(rand(1,21));
    return [
        'level_id' => $level->id,
        'block_id' => $level->block_id,
        'name' => $faker->name,
        'name_display' => $faker->name,
        'text_size' => rand(12, 18) . 'px',
        'area_json' => '[]',
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
    ];
});
