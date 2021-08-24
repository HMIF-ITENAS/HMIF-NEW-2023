<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function getPaginatedPosts($limit = 10)
    {
        return Post::with(['user', 'category', 'tags'])->where('status', '=', 1)->where('category_id', '=', $this->id)->paginate($limit);
    }
}
