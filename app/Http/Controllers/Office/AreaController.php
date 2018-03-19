<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    function index()
    {
        return view('office.area.index');
    }
    function getList(Request $request)
    {
        $level = \App\Models\Level::with('areas')
            ->find($request->level_id);

        return view('office.area.list', compact('level'));
    }
    function getCreate()
    {
        $level = \App\Models\Level::find($request->level_id);

        return view('office.area.create');
    }
    function getEdit()
    {
        $area = \App\Models\Area::find($request->id);

        return view('office.area.edit', compact('area'));
    }
    function postCreate()
    {
        $area = new \App\Models\Area();
        $area->level_id = $request->level_id;
        $area->block_id = \App\Models\Area::find($request->level_id)->block_id;
        $area->name = $request->name;
        $area->name_display = $request->name_display;
        $area->text_size = $request->text_size;
        $area->categories()->sync([$request->category_ids]);
        $area->area_json = json_encode([]);
        $area->save();

        return back()->with('success', 'Success');
    }
    function postEdit()
    {
        $area = \App\Models\Area::find($request->id);
        $area->name = $request->name;
        $area->name_display = $request->name_display;
        $area->text_size = $request->text_size;
        $area->categories()->sync([$request->category_ids]);
        $area->area_json = $request->area_json;
        $area->save();

        return back()->with('success', 'Success');
    }
    function postDelete()
    {
        $area = \App\Models\Area::find($request->id);
        $levelId = $area->level_id;
        $area->delete();

        return redirect('/back-office/area/list/' . $levelId)->with('success', 'Success');
    }
}
