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
        return view('office.area.create');
    }
    function getEdit()
    {
        return view('office.area.edit');
    }
    function postCreate()
    {
        return back()->with('success', 'Success');
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
