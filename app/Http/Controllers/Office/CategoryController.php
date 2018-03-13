<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function getList(Request $request)
    {

        return view('office.category.list');
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
    function postEdit(Request $request)
    {

        return back()->with('success', 'Success');
    }
}
