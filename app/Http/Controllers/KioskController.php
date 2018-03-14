<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KioskController extends Controller
{
    function index()
    {
        $blocks = \App\Models\Block::with('levels', 'levels.areas', 'levels.zones')->get()->toJson();
        return view('index', compact('blocks'));
    }
}
