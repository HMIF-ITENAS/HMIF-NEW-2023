<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalAspiration extends Model
{
    protected $guarded = [];
    protected $table = 'internal_aspirations';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
