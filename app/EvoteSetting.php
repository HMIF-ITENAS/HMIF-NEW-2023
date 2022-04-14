<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvoteSetting extends Model
{
    use HasFactory;
    protected $table = 'evote_settings';
    protected $guarded = [];
}
