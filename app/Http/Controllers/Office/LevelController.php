<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    function index(Request $request)
    {
        $levels = \App\Models\Level::all();
        return view('office.level.index', compact('levels'));
    }
    function getList(Request $request)
    {
        $block = \App\Models\Block::find($request->block_id);
        $blocks = \App\Models\Block::all();
        return view('office.level.list', compact('block', 'blocks'));
    }
    function getEdit()
    {
        return view('office.level.edit');
    }
    function postEdit(Request $request)
    {

        return back()->with('success', 'Success');
    }
}
