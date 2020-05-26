<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Activity;
use App\Comment;
use App\Calendar;

class CommentsController extends Controller
{
    public function store (Request $request)
    {
        $this->validate($request,[
            'comments' => 'required|max:191',
        ]);
        
        Comment::create([
            'user_id' => $request->user()->id,
            'activity_id' => $request->activity_id,
            'comments' => $request->comments,
        ]);
        
        return back();
    }
    
    public function show(Request $request, $activity_id)
    {
        $activity = Activity::find($activity_id);
        $user = User::where('id', $activity->user_id)->first();
        $targetuser = $activity->user_id;
        $followings = $user->followings()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $tag = $cal->showCalendarTag($request->month,$request->year,'',$targetuser);
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
        $comments = Comment::where('activity_id', '=', $activity_id)->get();
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag,
            'activities' => $activities,
            'activity' => $activity,
            'comments' => $comments,
        ];
        $data += $this->counts($user);
        
        return view('comments.show',$data);
    }
}
