<?php

use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Area::class, 300)->create()
            ->each(function($area) {
                $randomCategory = \App\Models\Category::find(rand(1, 23));
                $area->categories()->attach($randomCategory);
            });
        factory(\App\Models\Zone::class, 60)->create();

    }
}
