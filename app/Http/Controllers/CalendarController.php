<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Activity;

use App\Calendar;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year);

        return view('calendar.index', ['cal_tag' => $tag]);
    }
    
    public function getActivities (Request $request)
    {
        $list = Activity::all();
        return view('welcome', ['list' => $list]);
    }
}