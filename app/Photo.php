<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
