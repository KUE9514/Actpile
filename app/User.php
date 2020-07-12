<?php

namespace App;

use App\Activity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        $exist = $this->is_following('$userId');
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_activities()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Activity::whereIn('user_id', $follow_user_ids);
    }
    
    public function applauses()
    {
        return $this->belongsToMany(Activity::class, 'applauses', 'user_id', 'activity_id')->withTimestamps();
    }
    
    public function applause($activityId)
    {
        if ($this->is_applauses($activityId))
        {
            return false;
        } else {
            $this->applauses()->attach($activityId);
            return true;
        }
    }
    
    public function unapplause($activityId)
    {
        $this->applauses()->detach($activityId);
        return true;
    }
    
    public function is_applauses($activityId)
    {
        return $this->applauses()->where('activity_id', $activityId)->exists();
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
