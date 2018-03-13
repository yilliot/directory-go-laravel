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
    function getList()
    {
        return view('office.zone.getList');
    }
    function getCreate()
    {
        return view('office.zone.getCreate');
    }
    function getEdit()
    {
        return view('office.zone.getEdit');
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
