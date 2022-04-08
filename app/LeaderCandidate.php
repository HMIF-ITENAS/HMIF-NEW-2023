<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderCandidate extends Model
{
    use HasFactory;

    protected $table = 'leader_candidates';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function voters()
    {
        return $this->belongsToMany('App\User', 'candidate_voters', 'leader_candidate_id', 'voter_id')->withPivot(['id'])->withTimestamps();
    }

    public function getFoto()
    {
        if (substr($this->foto, 0, 5) == "https") {
            return $this->foto;
        }
        if ($this->foto) {
            $status = $this->status == 1 ? 'kahim' : 'bpa';
            return asset("assets/kandidat/$status/$this->foto");
        }
        return 'https://via.placeholder.com/1080x1080.png?text=No+Cover';
    }
}
