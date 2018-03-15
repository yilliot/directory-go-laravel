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
                    ->map(function($items, $id){
                        return collect([
                            'id' => $id,
                            'name' => $items->first()->category_name,
                            'areas' => $items,
                        ]);
                    });
            });

        $zonesByCategories = \DB::table('zones')
            ->join('zone_categories', 'zones.zone_category_id', '=', 'zone_categories.id')
            ->select('zones.*', 'zone_categories.name as category_name')
            ->get()
            ->groupBy('level_id')
            ->map(function($items, $levelId){
                return $items->groupBy('zone_category_id')
                    ->map(function($items, $id){
                        return collect([
                            'id' => $id,
                            'name' => $items->first()->category_name,
                            'zones' => $items,
                        ]);
                    });
            });

        $blocks = $blocks->map(function($block) use ($areasByCategories, $zonesByCategories) {

            return $block->levels->map(function($level) use ($areasByCategories, $zonesByCategories) {
                $level = $level->toArray();
                $level['area_categories'] = $areasByCategories->get($level['id']);
                $level['zone_categories'] = $zonesByCategories->get($level['id']);
                return $level;
            });
        });

        return view('index', compact('blocks'));
    }
}
