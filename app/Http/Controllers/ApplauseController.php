<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplauseController extends Controller
{
    public function store(Request $repuest, $id)
    {
        \Auth::user()->applause($id);
        return back();
    }
}
