<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    function getEdit(Request $request)
    {
        $block = \App\Models\Block::find($request->id);
        return view('office.block.edit', compact('block'));
    }

    function postEdit(Request $request)
    {
        $block = \App\Models\Block::find($request->id);
        $block->name = $request->name;
        $block->save();

        // reset level
        \App\Models\Level::where('block_id', $request->id)
            ->update(['is_activated' => false]);
        \App\Models\Level::whereIn('id', collect($request->levels)->keys())
            ->update(['is_activated' => true]);

        return redirect()->back()->with('success', 'Success');
    }
}
