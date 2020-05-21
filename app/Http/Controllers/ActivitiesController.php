<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Calendar;

use App\Activity;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if (\Auth::check())
        {
            $user = \Auth::user();
            $list = Activity::all();
            $cal = new Calendar($list);
            $tag = $cal->showCalendarTag($request->month,$request->year,"");
            
            $activities = $user->feed_activities()->orderBy('created_at', 'desc')->paginate(10);
            
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
    
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year,'');
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag,
            'activities' => $activities,
        ];
        return view('activities.show',$data);
    }
}
