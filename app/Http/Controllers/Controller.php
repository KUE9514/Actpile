<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_activities = $user->activities()->count();
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        //$count_applauses = $user->apprauses()->count();
        
        return [
            'count_activities' => $count_activities,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            //'count_applauses' => $count_applauses,
        ];
    }
}
