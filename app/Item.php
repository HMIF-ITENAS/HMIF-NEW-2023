<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    protected $table = 'items';

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }
}
