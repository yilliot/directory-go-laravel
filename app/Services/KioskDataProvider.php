<?php

namespace App\Services;

class KioskDataProvider
{
    function getLocationDirection($slug)
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

        // facilities index
        $facilitiesIndex = $this->generateFacilitiesIndex();

        // meeting room index A-G
        // meeting room index H-O
        // meeting room index P-Z
        $meetingRoomIndex = $this->generateMeetingRoomIndex();

        return collect(compact('blocks', 'kampongIndex', 'facilitiesIndex', 'meetingRoomIndex'));
    }

    function generateMeetingRoomIndex() {
        $meetingRooms = \App\Models\Category::with('areas', 'areas.level', 'areas.level.block')
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
                });
            })
            ->toArray();
        return $meetingRooms;
    }

    function generateKampongIndex() {
        $kampongs = \App\Models\Block::with('levels', 'levels.zones', 'levels.zones.zoneCategory')
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
                                        if($zone->zoneCategory->id == 1) {
                                            $result = [
                                                'name' => $zone->name,
                                                'name_display' => $zone->name_display,
                                                'text_size' => $zone->text_size,
                                                'area_json' => $zone->area_json,
                                                'category' => $zone->zoneCategory->name,
                                                'level' => $zone->level->name,
                                                'block' => $zone->block->name,
                                                'bg_colour' => $zone->block->bg_colour,
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
        $facilities = \App\Models\Block::with('levels', 'levels.areas', 'levels.areas.categories')
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
                                        if($area->categories->first()->id == 23) {
                                            $result = [
                                                'name' => $area->name,
                                                'name_display' => $area->name_display,
                                                'text_size' => $area->text_size,
                                                'area_json' => $area->area_json,
                                                'category' => $area->categories->first()->name,
                                                'level' => $area->level->name,
                                                'block' => $area->block->name,
                                                'bg_colour' => $area->block->bg_colour,
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
        $blocks = \App\Models\Block::with('levels')->get();

        $areasByCategories = \DB::table('areas')
            ->join('area_categories', 'areas.id', '=', 'area_categories.area_id')
            ->join('categories', 'categories.id', '=', 'area_categories.category_id')
            ->select('areas.*', 'area_categories.category_id', 'categories.name as category_name')
            ->get()
            ->groupBy('level_id')
            ->map(function($items, $levelId){
                return $items->groupBy('category_id')
                    ->map(function($itemsLv2, $id){
                        return [
                            'id' => $id,
                            'name' => $itemsLv2->first()->category_name,
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
                    });
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
                $level = $level->only(['id', 'name', 'map_path', 'level_order', 'is_activated']);
                if (isset($areasByCategories[$level['id']])) {
                    $level['area_categories'] = $areasByCategories[$level['id']];
                }
                if (isset($zonesByCategories[$level['id']])) {
                    $level['zone_categories'] = $zonesByCategories[$level['id']];
                }
                return $level;
            });

            $block = $block->only(['id', 'name', 'bg_colour', 'text_colour', 'order']);
            $block['levels'] = $levels->toArray();

            return $block;
        });

        return $blocks;

    }
}