<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'time', 'content', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
