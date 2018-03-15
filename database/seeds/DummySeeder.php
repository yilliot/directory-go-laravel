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
        factory(\App\Models\Area::class, 1000)->create();
        factory(\App\Models\Zone::class, 1000)->create();
    }
}
