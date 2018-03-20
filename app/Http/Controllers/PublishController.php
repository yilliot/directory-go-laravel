<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishController extends Controller
{
    function getVersion()
    {
        $latest = \App\Models\Publish::latest()->first();
        return ['version' => $latest->id, 'updated_at' => $latest->created_at->toDatetimeString()];
    }

    function getData()
    {
        return [app(\App\Services\KioskDataProvider::class)->getLatestData()->data];
    }
}
