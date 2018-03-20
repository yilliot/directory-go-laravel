<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KioskController extends Controller
{
    function published(Request $request)
    {
        // cached from publishes table
        $s = app(\App\Services\KioskDataProvider::class);
        $blocks = $s->getLatestData()->data;
        $location = $s->getLocationDirection($request->slug? $request->slug : 'k1');

        return view('index', compact('blocks', 'location'));
    }

    function preview(Request $request)
    {
        // realtime from db
        $s = app(\App\Services\KioskDataProvider::class);
        $blocks = $s->generateData();
        $location = $s->getLocationDirection($request->slug? $request->slug : 'k1');

        return view('index', compact('blocks', 'location'));
    }

    function index()
    {
        return redirect('/kiosk/preview');
    }

    public function drawing()
    {
        return view('part.drawing');
        return view('drawing');
    }
}
