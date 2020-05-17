<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Calendar;

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
        $tag = $cal->showCalendarTag($request->month,$request->year);

        return view('users.show', [
            'user' =>$user,
            'cal_tag' => $tag
        ]);
    }
}
