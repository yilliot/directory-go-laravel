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
    function getUserUpdate(Request $request)
    {
        return view('office.user.update');
    }
    function postUserUpdate(Request $request)
    {
        $user = \Auth::user();
        if (\Auth::attempt(['email' => $user->email, 'password' => $request->get('password')])) {
            $user->email = $request->get('email');
            $user->password = bcrypt($request->get('new_password'));
            $user->save();
        }
        \Auth::logout();
        return back();
    }
}
