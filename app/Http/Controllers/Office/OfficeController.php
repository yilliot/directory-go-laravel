<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    function index(Request $request)
    {
        return redirect('/back-office/level/list/1');
    }
}
