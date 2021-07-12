<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $guarded = [];

    public function meeting_category()
    {
        return $this->belongsTo('App\MeetingCategory');
    }
}
