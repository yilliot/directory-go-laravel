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
    function postCreate(Request $request)
    {

        return back()->with('success', 'Success');
    }
    function postEdit(Request $request)
    {

        return back()->with('success', 'Success');
    }
    function postDelete(Request $request)
    {

        return back()->with('success', 'Success');
    }
}
