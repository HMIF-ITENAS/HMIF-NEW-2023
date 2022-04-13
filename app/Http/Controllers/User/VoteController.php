<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $title = "E-Vote";
        return view('user.e-vote.index', compact('title'));
    }

    public function kahim()
    {
        $title = "Kahim";
        $data = LeaderCandidate::with(['user'])->kahim()->get();
        return view('user.e-vote.kahim', compact('title', 'data'));
    }
}
