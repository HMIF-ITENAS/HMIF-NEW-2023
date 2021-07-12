<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingCategory extends Model
{
    protected $guarded = [];
    protected $table = 'meeting_categories';

    public function meetings()
    {
        return $this->hasMany('App\Meeting');
    }
}
