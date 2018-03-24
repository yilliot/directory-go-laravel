<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    function getList(Request $request)
    {
        $level = \App\Models\Level::with('areas', 'areas.categories')
            ->find($request->level_id);

        $levels = \App\Models\Level::with('block')
            ->where('is_activated', true)
            ->get();

        $category_area = \App\Models\Category::with('areas', 'areas.level')
            ->get()
            ->map(function($category) use ($request) {
                return [
                    'id' => $category->id,
                    'area_jsons' => $category->areas->map(function($area) use ($request) {
                        return $area->level_id == $request->level_id ? $area: null;
                    }),
                ];
            });

        $categories = $level->areas->map(function($area){
            return $area->categories;
        })->flatten()->unique('id')->values();


        return view('office.area.list', compact('level', 'levels', 'category_area', 'categories'));
    }
    function getCreate(Request $request)
    {
        $level = \App\Models\Level::find($request->level_id);

        return view('office.area.create', compact('level'));
    }
    function getEdit(Request $request)
    {
        $area = \App\Models\Area::find($request->id);

        return view('office.area.edit', compact('area'));
    }
    function postCreate(Request $request)
    {
        $area = new \App\Models\Area();
        $area->level_id = $request->level_id;
        $area->block_id = \App\Models\Level::find($request->level_id)->block_id;
        $area->name = $request->name;
        $area->name_display = $request->name_display;
        $area->text_size = '16px';
        $area->area_json = json_encode([]);
        $area->save();

        $area->categories()->sync($request->area_category_ids);

        return redirect('/back-office/area/edit/'.$area->id)->with('success', 'Success');
    }
    function postEdit(Request $request)
    {
        $area = \App\Models\Area::find($request->id);
        $area->name = $request->name;
        $area->name_display = $request->name_display;
        $area->text_size = $request->text_size;
        $area->area_json = $request->area_json;
        $area->save();

        $area->categories()->sync($request->area_category_ids);

        return back()->with('success', 'Success');
    }
    function postDelete(Request $request)
    {
        $area = \App\Models\Area::find($request->id);
        $levelId = $area->level_id;
        $area->delete();

        return redirect('/back-office/area/list/' . $levelId)->with('success', 'Success');
    }
}
