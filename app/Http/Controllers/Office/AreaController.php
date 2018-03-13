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
    function getList()
    {
        return view('office.area.getList');
    }
    function getCreate()
    {
        return view('office.area.getCreate');
    }
    function getEdit()
    {
        return view('office.area.getEdit');
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
