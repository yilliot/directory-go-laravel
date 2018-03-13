<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    function postEdit(Request $request)
    {

        return redirect()->back()->with('success', 'Success');
    }
}
