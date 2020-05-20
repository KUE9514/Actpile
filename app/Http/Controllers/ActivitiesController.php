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
        if (\Auth::check())
        {
            $user = \Auth::user();
            $cal = new Calendar();
            $tag = $cal->showCalendarTag($request->month,$request->year,"");
            
            $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' =>$user,
                'cal_tag' => $tag,
                'activities' => $activities,
            ];
        }
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
             
             'title' => 'required|max:10',
             ]);
        $request->user()->activities()->create([
            'day' => $request->day,
            'title' => $request->title,
            'content' => $request->content,
            'time' => $request->time,
            ]);
        return back();
    }
    
    public function destroy($id)
    {
        $activity = \App\Activity::find($id);
        
        if(\Auth::id() === $activity->user_id) {
            $activity->delete();
    }
    
    return back();
    }
}
