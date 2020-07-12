<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Calendar;
use App\Activity;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $list = Activity::all();
        $cal = new Calendar($list);
        $path = '/users/'. $id;
        $tag = $cal->showCalendarTag($request->month,$request->year,$path,$id);
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);
        $total_time = Activity::where('user_id',$id)->sum('time');
        
        $data = [
            'user' =>$user,
            'cal_tag' => $tag,
            'activities' => $activities,
            'user_time' => $total_time,
        ];
        
        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
    public function followings(Request $request, $id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $path = '/users/'. $id. '/followings';
        $tag = $cal->showCalendarTag($request->month,$request->year,$path,$id);
        $total_time = Activity::where('user_id',$id)->sum('time');
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag,
            'user_time' => $total_time,
        ];
        
        $data += $this->counts($user);
        
        return view('users.followings', $data);
    }
    
    public function followers(Request $request, $id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        $list = Activity::all();
        $cal = new Calendar($list);
        $path = '/users/'. $id. '/followers';
        $tag = $cal->showCalendarTag($request->month, $request->year, $path, $id);
        $total_time = Activity::where('user_id',$id)->sum('time');
        
        $data = [
            'user' => $user,
            'users' => $followers,
            'cal_tag' => $tag,
            'user_time' => $total_time,
        ];
        
        $data += $this->counts($user);
        
        return view('users.followers', $data);
    }
    
    public function applauses(){
        $user = User::find($id);
        
        $data = [
            'user' => $user,
        ];
        $data += $this->counts($user);
    }
}
