<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    function getList(Request $request)
    {
        $block = \App\Models\Block::find($request->block_id);
        $blocks = \App\Models\Block::all();
        return view('office.level.list', compact('block', 'blocks'));
    }
    function getEdit(Request $request)
    {
        $level = \App\Models\Level::find($request->id);

        return view('office.level.edit', compact('level'));
    }
    function postEdit(Request $request)
    {
        $level = \App\Models\Level::find($request->id);
        $level->name = $request->name;
        if ($request->has('map_path')) {
            $level->map_path = $request->file('map_path')->store('map_path', 'public');
        }
        $level->save();

        return back()->with('success', 'Success');
    }
}
