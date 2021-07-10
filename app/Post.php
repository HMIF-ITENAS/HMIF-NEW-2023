<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function getBanner()
    {
        if (substr($this->banner, 0, 5) == "https") {
            return $this->banner;
        }
        if ($this->banner) {
            return asset("assets/banner/$this->banner");
        }
        return 'https://via.placeholder.com/1080x1080.png?text=No+Cover';
    }
}
