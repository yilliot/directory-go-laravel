<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KioskController extends Controller
{
    function getEdit(Request $request)
    {
        $kiosk = \App\Models\Kiosk::where('id', $request->id)->first();
        return view('office.kiosk.edit', compact('kiosk'));
    }

    function postEdit(Request $request)
    {
        $kiosk = \App\Models\Kiosk::where('id', $request->id)->first();
        $kiosk->slug = $request->slug;
        $kiosk->level_id = $request->level_id;
        $kiosk->direction = $request->direction;
        $kiosk->save();

        return back()->with('success', 'Success');
    }
}
