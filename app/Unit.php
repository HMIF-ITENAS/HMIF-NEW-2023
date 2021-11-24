<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [];
    protected $table = 'units';

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
