<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category');//relationship dekhako category sangha
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');//post has multipe tags
    }

    public function comments()
    {
    	return $this->hasMany('App\Comment');
    }
}
