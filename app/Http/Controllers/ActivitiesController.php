<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Calendar;
use App\Activity;
use App\Comment;
use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        if (\Auth::check())
        {
            $targetuserId = \Auth::id();
            $user = \Auth::user();
            $totalsec = Activity::where('user_id',$targetuserId)->sum(DB::raw('TIME_TO_SEC(time)'));
            $userTimesum = gmdate("i", $totalsec);
            $totalhour = $totalsec/3600;
            $list = Activity::all();
            $cal = new Calendar($list);
            $tag = $cal->showCalendarTag($request->month,$request->year,'',$targetuserId);
            $activities = $user->feed_activities()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' =>$user,
                'cal_tag' => $tag,
                'activities' => $activities,
                'user_time' => substr($totalhour,0,2)."h". $userTimesum."m",
            ];
            $data += $this->counts($user);
        }
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
             'day' => 'required',
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
        
        if(\Auth::id() === $activity->user->id) {
            $activity->delete();
        }
    
        return redirect('/');
    }
    
    public function show(Request $request, $id, $activity_id)
    {
        $user = User::find($id);
        $activity = Activity::find($activity_id);
        $followings = $user->followings()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $path = '/users/' . $id . '/activities/' . $activity_id;
        $tag = $cal->showCalendarTag($request->month,$request->year,$path,$id);
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
        $comments = Comment::find($activity_id);
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag,
            'activities' => $activities,
            'activity' => $activity
        ];
        $data += $this->counts($user);
        
        return view('activities.show',$data);
    }
    
    public function edit (Request $request, $id, $activity_id) 
    {
        $user = User::find($id);
        $activity = Activity::find($activity_id);
        $followings = $user->followings()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year,'',$id);
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
        
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag,
            'activities' => $activities,
            'activity' => $activity
        ];
        $data += $this->counts($user);
        return view('activities.edit', $data);
    }
    
    public function update (Request $request)
    {
        $this->validate($request, [
             'day' => 'required',
             'title' => 'required|max:10',
        ]);
        $activity = Activity::find($request->activity_id);
        $activity->day = $request->day;
        $activity->title = $request->title;
        $activity->content = $request->content;
        $activity->time = $request->time;
        $activity->save();

        return redirect('/users/' . $activity->user_id . '/activities/' . $request->activity_id);
    }
}
