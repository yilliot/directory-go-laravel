<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KioskController extends Controller
{
    function index()
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
                $level = $level->only(['id', 'name', 'map_path', 'level_order']);
                if (isset($areasByCategories[$level['id']])) {
                    $level['area_categories'] = $areasByCategories[$level['id']];
                }
                if (isset($zonesByCategories[$level['id']])) {
                    $level['zone_categories'] = $zonesByCategories[$level['id']];
                }
                return $level;
            });

            $block = $block->only(['id', 'name', 'colour', 'order']);
            $block['levels'] = $levels->toArray();

            return $block;
        });

        return view('index', compact('blocks'));
    }

    public function drawing() {
        return view('drawing');
    }
}
