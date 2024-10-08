<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SidemenuController extends Controller
{
    public function redirect(Request $request)
    {
        return redirect()->route($request->input('route_name'));
    }
}
