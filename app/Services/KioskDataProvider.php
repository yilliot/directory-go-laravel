<?php

namespace App\Services;

class KioskDataProvider
{
    function getLocationDirection($slug = 'k1')
    {
        return \App\Models\KioskLocation::where('slug', $slug)
            ->first();
    }
    function getLatestData()
    {
        return \App\Models\Publish::latest()->first();
    }

    function generateData()
    {
        $blocks = $this->generateBlock();
        // $zoneCategories = $this->generateZoneCategories();
        // $areaCategories = $this->generateAreaCategories();

        // kampong index
        $kampongIndex = $this->generateKampongIndex();

        // // facilities index
        $facilitiesIndex = $this->generateFacilitiesIndex();

        // // meeting room index A-G
        // // meeting room index H-O
        // // meeting room index P-Z
        $meetingRoomIndex = $this->generateMeetingRoomIndex();

        return collect(compact('blocks', 'kampongIndex', 'facilitiesIndex', 'meetingRoomIndex', 'buildingCore'));
    }

    function generateMeetingRoomIndex() {
        $meetingRooms = \App\Models\Category::with('areas', 'areas.level', 'areas.block', 'areas.categories')
            ->where('id', 2)
            ->first()
            ->areas
            ->groupBy(function($item){
                $firstChar = strtoupper($item->name[0]);
                if (in_array($firstChar, range('A', 'G'))) {
                    return 'A-G';
                } else if (in_array($firstChar, range('H', 'O'))) {
                    return 'H-O';
                } else {
                    return 'P-Z';
                }
            })
            ->map(function($group) {
                return $group->map(function($item){
                    return [
                        'name' => $item->name,
                        'name_display' => $item->name_display,
                        'text_size' => $item->text_size,
                        'area_json' => $item->area_json,
                        'category' => $item->categories->first()->name,
                        'level' => $item->level->name,
                        'block' => $item->block->name,
                        'bg_colour' => $item->block->bg_colour,
                    ];
                })->sortBy('name')->values();
            })
            ->toArray();
        return $meetingRooms;
    }

    function generateKampongIndex() {
        $kampongs = \App\Models\Block::with('levels', 'levels.zones', 'levels.zones.zoneCategory', 'levels.zones.level', 'levels.zones.block')
            ->get()
            ->map(function($block) {
                return [
                    'id' => $block->id,
                    'name' => $block->name,
                    'bg_colour' => $block->bg_colour,
                    'text_colour' => $block->text_colour,
                    'order' => $block->order,
                    'levels' => $block
                        ->levels
                        ->map(function($level) {
                            return [
                                'name' => $level->name,
                                'level_order' => $level->level_order,
                                'is_activated' => $level->is_activated,
                                'zones' => $level
                                    ->zones
                                    ->map(function($zone) {
                                        $result = [];
                                        if($zone->zoneCategory && $zone->zoneCategory->id == 1) {
                                            $result = [
                                                'name' => $zone->name,
                                                'name_display' => $zone->name_display,
                                                'text_size' => $zone->text_size,
                                                'area_json' => $zone->area_json,
                                                'category' => $zone->zoneCategory->name,
                                                'level' => $zone->level->name,
                                                'block' => $zone->block->name,
                                                'bg_colour' => $zone->bg_colour,
                                            ];
                                        }
                                        return $result;
                                    }),
                            ];
                        }),
                ];
            })
            ->toArray();

        return $kampongs;
    }

    function generateFacilitiesIndex()
    {
        $facilities = \App\Models\Block::with('levels', 'levels.areas', 'levels.areas.categories', 'levels.areas.block', 'levels.areas.level')
            ->get()
            ->map(function($block) {
                return [
                    'id' => $block->id,
                    'name' => $block->name,
                    'bg_colour' => $block->bg_colour,
                    'text_colour' => $block->text_colour,
                    'order' => $block->order,
                    'levels' => $block
                        ->levels
                        ->map(function($level) {
                            return [
                                'name' => $level->name,
                                'level_order' => $level->level_order,
                                'is_activated' => $level->is_activated,
                                'areas' => $level
                                    ->areas
                                    ->map(function($area) {
                                        $result = [];
                                        if($area->categories->find(23)) {
                                            $result = [
                                                'name' => $area->name,
                                                'name_display' => $area->name_display,
                                                'text_size' => $area->text_size,
                                                'area_json' => $area->area_json,
                                                'category' => $area->categories->first()->name,
                                                'level' => $area->level->name,
                                                'block' => $area->block->name,
                                            ];
                                        }
                                        return $result;
                                    }),
                            ];
                        }),
                ];
            })
            ->toArray();

        return $facilities;
    }

    function generateAreaCategories()
    {
        $areaCategories = \App\Models\Category::with('areas')
            ->orderBy('order', 'asc')
            ->get();

        return $areaCategories;
    }

    function generateZoneCategories()
    {
        $zoneCategories = \App\Models\ZoneCategory::with('zones')
            ->orderBy('order', 'asc')
            ->get();

        return $zoneCategories;
    }

    function generateBlock()
    {
        $blocks = \App\Models\Block::with(['levels', 'levels.zones' => function($q) {
            $q->where('zone_category_id', 3);
        }])->get();

        $areasByCategories = \DB::table('areas')
            ->join('area_categories', 'areas.id', '=', 'area_categories.area_id')
            ->join('categories', 'categories.id', '=', 'area_categories.category_id')
            ->select('areas.*', 'area_categories.category_id', 'categories.name as category_name', 'categories.order as category_order')
            ->where('categories.id', '<>', 23) // hide facilities index in levels
            ->orderBy('category_order', 'asc')
            ->get()
            ->groupBy('level_id')
            ->map(function($items, $levelId){
                return $items->groupBy('category_id')
                    ->map(function($itemsLv2, $id){
                        return [
                            'id' => $id,
                            'name' => $itemsLv2->first()->category_name,
                            'order' => $itemsLv2->first()->category_order,
                            'areas' => $itemsLv2->map(function($itemLv2){
                                return [
                                    'id' => $itemLv2->id,
                                    'name' => $itemLv2->name,
                                    'name_display' => $itemLv2->name_display,
                                    'text_size' => $itemLv2->text_size,
                                    'area_json' => $itemLv2->area_json,
                                ];
                            })->toArray(),
                        ];
                    })->values();
            })->toArray();

        $zonesByCategories = \DB::table('zones')
            ->join('zone_categories', 'zones.zone_category_id', '=', 'zone_categories.id')
            ->select('zones.*', 'zone_categories.name as category_name')
            ->get()
            ->groupBy('level_id')
            ->map(function($items, $levelId){
                return $items->groupBy('zone_category_id')
                    ->map(function($itemsLv2, $id){
                        return [
                            'id' => $id,
                            'name' => $itemsLv2->first()->category_name,
                            'zones' => $itemsLv2->map(function($itemLv2){
                                return [
                                    'id' => $itemLv2->id,
                                    'name' => $itemLv2->name,
                                    'name_display' => $itemLv2->name_display,
                                    'bg_colour' => $itemLv2->bg_colour,
                                    'text_colour' => $itemLv2->text_colour,
                                    'text_size' => $itemLv2->text_size,
                                    'area_json' => $itemLv2->area_json,
                                ];
                            })->toArray(),
                        ];
                    });
            })->toArray();

        $blocks = $blocks->map(function($block) use ($areasByCategories, $zonesByCategories) {

            $levels = $block->levels->map(function($level) use ($areasByCategories, $zonesByCategories) {

                $return = $level->only(['id', 'name', 'map_path', 'level_order', 'is_activated']);

                $return['building_core'] = $level->zones
                    ->map(function($zone) {
                        return [
                            'id' => $zone->id,
                            'area_json' => $zone->area_json,
                        ];
                    })->toArray();
                if (isset($areasByCategories[$return['id']])) {
                    $return['area_categories'] = $areasByCategories[$return['id']];
                }
                if (isset($zonesByCategories[$return['id']])) {
                    $return['zone_categories'] = $zonesByCategories[$return['id']];
                }
                return $return;
            });

            $block = $block->only(['id', 'name', 'bg_colour', 'text_colour', 'order']);
            $block['levels'] = $levels->toArray();

            return $block;
        });

        return $blocks;

    }
}