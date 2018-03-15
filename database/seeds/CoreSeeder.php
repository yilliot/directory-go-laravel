<?php

use Illuminate\Database\Seeder;

class CoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->runUser();
        $this->runBlock();
        $this->runLevel();
        $this->runCategory();
        $this->runZoneCategory();
    }

    private function runUser()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => 'GO Admin',
            'email' => 'goadmin@gmail.com',
            'password' => bcrypt('lemon-barley-080'),
        ]);
    }

    private function runBlock()
    {
        DB::table('blocks')->truncate();
        DB::table('blocks')->insert([
            'name' => '60',
            'colour' => '#ffc529',
            'order' => 1,
        ]);
        DB::table('blocks')->insert([
            'name' => '70',
            'colour' => '#ec677e',
            'order' => 2,
        ]);
        DB::table('blocks')->insert([
            'name' => '80',
            'colour' => '#00a6c7',
            'order' => 3,
        ]);
    }

    private function runLevel()
    {
        DB::table('levels')->truncate();
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 3,
            'name' => 'L3',
            'map_path' => 'map_path/_0012_60 L3.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 4,
            'name' => 'L4',
            'map_path' => 'map_path/_0011_60 L4.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 5,
            'name' => 'L5',
            'map_path' => 'map_path/_0010_60 L5.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 6,
            'name' => 'L6',
            'map_path' => 'map_path/_0009_60 L6.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 7,
            'name' => 'L7',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 8,
            'name' => 'L8',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 9,
            'name' => 'L9',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 10,
            'name' => 'L10',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 11,
            'name' => 'L11',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 12,
            'name' => 'L12',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 13,
            'name' => 'L13',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '1',
            'level_order' => 14,
            'name' => 'L14',
            'map_path' => null,
            'is_activated' => false,
        ]);

        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 3,
            'name' => 'L3',
            'map_path' => 'map_path/_0008_70 L3.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 4,
            'name' => 'L4',
            'map_path' => 'map_path/_0007_70 L4.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 5,
            'name' => 'L5',
            'map_path' => 'map_path/_0006_70 L5.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 6,
            'name' => 'L6',
            'map_path' => 'map_path/_0005_70 L6.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 7,
            'name' => 'L7',
            'map_path' => 'map_path/_0004_70 L7.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 8,
            'name' => 'L8',
            'map_path' => 'map_path/_0003_70 L8.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 9,
            'name' => 'L9',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 10,
            'name' => 'L10',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 11,
            'name' => 'L11',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 12,
            'name' => 'L12',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 13,
            'name' => 'L13',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '2',
            'level_order' => 14,
            'name' => 'L14',
            'map_path' => null,
            'is_activated' => false,
        ]);

        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 3,
            'name' => 'L3',
            'map_path' => null,
            'is_activated' => false,
        ]);
         DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 4,
            'name' => 'L4',
            'map_path' => null,
            'is_activated' => false,
        ]);
         DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 5,
            'name' => 'L5',
            'map_path' => null,
            'is_activated' => false,
        ]);
         DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 6,
            'name' => 'L6',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 7,
            'name' => 'L7',
            'map_path' => 'map_path/_0002_80 L7.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 8,
            'name' => 'L8',
            'map_path' => 'map_path/_0001_80 L8.jpg',
            'is_activated' => true,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 9,
            'name' => 'L9',
            'map_path' => 'map_path/_0000_80 L9.jpg',
            'is_activated' => true,
        ]);

        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 10,
            'name' => 'L10',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 11,
            'name' => 'L11',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 12,
            'name' => 'L12',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 13,
            'name' => 'L13',
            'map_path' => null,
            'is_activated' => false,
        ]);
        DB::table('levels')->insert([
            'block_id' => '3',
            'level_order' => 14,
            'name' => 'L14',
            'map_path' => null,
            'is_activated' => false,
        ]);
    }


    private function runCategory()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            'name' => 'Meeting Rooms',
            'order' => 1,
        ]);
        DB::table('categories')->insert([
            'name' => 'Phone Rooms',
            'order' => 2,
        ]);
        DB::table('categories')->insert([
            'name' => 'Training spaces',
            'order' => 3,
        ]);
        DB::table('categories')->insert([
            'name' => 'Inovation spaces',
            'order' => 4,
        ]);
    }

    private function runZoneCategory()
    {
        DB::table('zone_categories')->truncate();
        DB::table('zone_categories')->insert([
            'name' => 'Kampong',
            'order' => 1,
        ]);
        DB::table('zone_categories')->insert([
            'name' => 'Micro Kitchen',
            'order' => 2,
        ]);
        DB::table('zone_categories')->insert([
            'name' => 'Building Core',
            'order' => 3,
        ]);
    }
}
