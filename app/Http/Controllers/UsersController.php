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
        
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year,$id);
        $activities = $user->activities()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', [
            'user' =>$user,
            'cal_tag' => $tag,
            'activities' => $activities,
        ]);
    }
    
    public function followings(Request $request, $id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year,'');
        
        $data = [
            'user' => $user,
            'users' => $followings,
            'cal_tag' => $tag
        ];
        
        $data += $this->counts($user);
        
        return view('users.followings', $data);
    }
    
    public function followers(Request $request, $id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        $cal = new Calendar();
        $tag = $cal->showCalendarTag($request->month,$request->year,'');
        
        $data = [
            'user' => $user,
            'users' => $followers,
            'cal_tag' => $tag
        ];
        
        $data += $this->counts($user);
        
        return view('users.followers', $data);
    }
}
