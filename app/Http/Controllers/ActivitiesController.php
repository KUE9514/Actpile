<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Calendar;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $user = \Auth::user();
        
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year);
        
        $data = [
            'user' =>$user,
            'cal_tag' => $tag
        ];
        return view('welcome', $data);
    }
}
