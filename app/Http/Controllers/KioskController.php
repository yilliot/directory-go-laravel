<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KioskController extends Controller
{
    function published(Request $request)
    {
        // cached from publishes table
        $s = app(\App\Services\KioskDataProvider::class);
        $latestData = $s->getLatestData();
        $blocks = $latestData->data;
        $version = $latestData->id;
        $location = $s->getLocationDirection($request->slug? $request->slug : 'k1');

        return view('index', compact('blocks', 'location', 'version'));
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
