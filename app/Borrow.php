<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $guarded = [];
    protected $table = 'borrows';

    public function items()
    {
        return $this->belongsToMany('App\Item')->withPivot(['id', 'qty'])->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
