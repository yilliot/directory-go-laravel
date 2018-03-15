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
    function getCreate()
    {
        return view('office.zone.create');
    }
    function getEdit()
    {
        return view('office.zone.edit');
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
