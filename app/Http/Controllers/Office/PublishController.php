<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    function postCreate(Request $request)
    {
        $publish = new \App\Models\Publish();
        $publish->data = app(\App\Services\KioskDataProvider::class)->generateData()->toJson();
        $publish->user_id = \Auth::user() ? \Auth::user()->id : 0;
        $publish->save();

        return back()->with('success', 'Success');
    }
}
