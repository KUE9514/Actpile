<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['activity_id', 'user_id', 'comments'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
