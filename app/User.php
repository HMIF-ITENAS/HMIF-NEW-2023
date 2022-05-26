<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'nrp', 'angkatan', 'status', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeAnggotaAktif($query)
    {
        return $query->where('status', '=', 'active')->where('level', '=', 'user');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function aspirations()
    {
        return $this->hasMany('App\InternalAspiration');
    }

    public function meetings()
    {
        return $this->belongsToMany('App\Meeting')->withPivot(['id', 'status'])->withTimestamps();
    }

    public function borrows()
    {
        return $this->hasMany('App\Borrow');
    }

    public function candidate()
    {
        return $this->hasOne('App\LeaderCandidate');
    }

    public function voters()
    {
        return $this->belongsToMany('App\LeaderCandidate', 'candidate_voters', 'voter_id', 'leader_candidate_id')->withPivot(['id'])->withTimestamps();
    }
}
