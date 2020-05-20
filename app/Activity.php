<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['day', 'title', 'time', 'content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
