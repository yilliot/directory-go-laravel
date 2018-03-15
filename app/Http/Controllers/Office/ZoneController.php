<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZoneController extends Controller
{
    function index()
    {
        return view('office.zone.index');
    }
    function getList(Request $request)
    {
        $level = \App\Models\Level::with('zones')
            ->find($request->level_id);

        return view('office.zone.list', compact('level'));
    }
    function getCreate(Request $request)
    {
        $level = \App\Models\Level::find($request->level_id);

        return view('office.zone.create', compact('level'));
    }
    function getEdit(Request $request)
    {
        $zone = \App\Models\Zone::find($request->id);

        return view('office.zone.edit', compact('zone'));
    }
    function postCreate(Request $request)
    {
        $zone = new \App\Models\Zone();
        $zone->level_id = $request->level_id;
        $zone->block_id = \App\Models\Level::find($request->level_id)->block_id;
        $zone->name = $request->name;
        $zone->name_display = $request->name_display;
        $zone->bg_colour = $request->bg_colour;
        $zone->text_size = '18px';
        $zone->text_colour = '#000';
        $zone->zone_category_id = $request->zone_category_id;
        $zone->area_json = json_encode([]);
        $zone->save();
        return redirect('/back-office/zone/edit/'.$zone->id)->with('success', 'Success');
    }
    function postEdit()
    {
        return back()->with('success', 'Success');
    }
    function postDelete()
    {
        return back()->with('success', 'Success');
    }
}
