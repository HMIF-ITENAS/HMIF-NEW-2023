<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingUser extends Model
{
    use HasFactory;
    public $table = 'meeting_user';
    protected $guarded = ['id'];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id');
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
