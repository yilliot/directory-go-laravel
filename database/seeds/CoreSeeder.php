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
        $this->runKisokLocation();
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
            'bg_colour' => '#ffc529',
            'text_colour' => '#000',
            'order' => 1,
        ]);
        DB::table('blocks')->insert([
            'name' => '70',
            'bg_colour' => '#ec677e',
            'text_colour' => '#000',
            'order' => 2,
        ]);
        DB::table('blocks')->insert([
            'name' => '80',
            'bg_colour' => '#00a6c7',
            'text_colour' => '#000',
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
    }


    private function runCategory()
    {
        DB::table('categories')->truncate();

        $order = 1;
        $list = [
            'Kampongs & Micro Kitchens',
            'Meeting Rooms',
            'Phone Rooms',
            'Training Spaces',
            'Innovation Spaces',
            'Utilities & Lockers',
            'Quiet Spaces',
            'Wellness Centre',
            'Music Room',
            'Youtube Studio',
            'Music Room & Youtube Studio',
            'Makerspace',
            'Reflection Corner',
            'First Aid',
            'Mother\'s Room',
            'Music Nook',
            'Energy Lab',
            'Shiok!',
            'Games Area',
            'Tech Stop',
            'Trattoria',
            'Reception',
            'Facilities Index',
        ];

        foreach ($list as $categoryName) {

            DB::table('categories')->insert([
                'name' => $categoryName,
                'order' => $order++,
            ]);
        }
    }

    private function runZoneCategory()
    {
        DB::table('zone_categories')->truncate();

        $order = 1;
        $list = [
            'Kampong',
            'Micro Kitchen',
            'Building Core',
        ];

        foreach ($list as $categoryName) {

            DB::table('zone_categories')->insert([
                'name' => $categoryName,
                'order' => $order++,
            ]);
        }
    }

    private function runKisokLocation()
    {
        DB::table('kiosk_locations')->truncate();

        $order = 1;
        $list = range(1, 30);

        foreach ($list as $index) {

            DB::table('kiosk_locations')->insert([
                'slug' => 'k' . $index,
                'level_id' =>  collect([1,2,3,4,6,7,8,9,10,11,17,18,19])->random(),
                'axis' => json_encode(['x' => rand(1, 1000), 'y' => rand(1, 1000)]),
            ]);

            $index++;
        }
    }
}
