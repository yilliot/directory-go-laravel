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
                        'category' => $item_area->zoneCategory->name,
                        'level' => $item_area->level->name,
                        'block' => $item_area->block->name,
                    ];
                });
            })
            ->toArray();
        return $meetingRooms;
    }

    function generateKampongIndex() {
        $kampongs = \App\Models\ZoneCategory::with('zones', 'zones.level', 'zones.level.block')
            ->where('id', 1)
            ->first()
            ->zones
            ->groupBy('block_id')
            ->map(function($item) {
                return [
                    'id' => $item->first()->level->block->id,
                    'name' => $item->first()->level->block->name,
                    'bg_colour' => $item->first()->level->block->bg_colour,
                    'text_colour' => $item->first()->level->block->text_colour,
                    'order' => $item->first()->level->block->order,
                    'levels' => $item
                        ->groupBy('level_id')
                        ->map(function($item_level){
                            return [
                                'name' => $item_level->first()->level->name,
                                'level_order' => $item_level->first()->level->level_order,
                                'is_activated' => $item_level->first()->level->is_activated,
                                'zones' => $item_level
                                    ->map(function($item_area){
                                        return [
                                            'name' => $item_area->name,
                                            'name_display' => $item_area->name_display,
                                            'text_size' => $item_area->text_size,
                                            'area_json' => $item_area->area_json,
                                            'category' => $item_area->zoneCategory->name,
                                            'level' => $item_area->level->name,
                                            'block' => $item_area->block->name,
                                        ];
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
        $facilities = \App\Models\Category::with('areas', 'areas.level', 'areas.level.block')
            ->where('id', 23)
            ->first()
            ->areas
            ->groupBy('block_id')
            ->map(function($item) {
                return [
                    'id' => $item->first()->level->block->id,
                    'name' => $item->first()->level->block->name,
                    'bg_colour' => $item->first()->level->block->bg_colour,
                    'text_colour' => $item->first()->level->block->text_colour,
                    'order' => $item->first()->level->block->order,
                    'levels' => $item
                        ->groupBy('level_id')
                        ->map(function($item_level){
                            return [
                                'name' => $item_level->first()->level->name,
                                'level_order' => $item_level->first()->level->level_order,
                                'is_activated' => $item_level->first()->level->is_activated,
                                'areas' => $item_level
                                    ->map(function($item_area){
                                        return [
                                            'name' => $item_area->name,
                                            'name_display' => $item_area->name_display,
                                            'text_size' => $item_area->text_size,
                                            'area_json' => $item_area->area_json,
                                            'category' => $item_area->categories->first()->name,
                                            'level' => $item_area->level->name,
                                            'block' => $item_area->block->name,

                                        ];
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