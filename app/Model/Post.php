<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamp = false;

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
