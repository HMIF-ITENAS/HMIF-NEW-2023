<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use Illuminate\Http\Request;

class EVoteController extends Controller
{
    public function index()
    {
        $title = 'HMIF E-Vote';
        $kandidatKahim = LeaderCandidate::with(['user'])->where('status', '=', '1')->orderBy('nomor_urut', 'asc')->get();
        $kandidatBpa = LeaderCandidate::with(['user'])->where('status', '=', '2')->orderBy('nomor_urut', 'asc')->get();
        return view('app.evote.index', compact('title', 'kandidatKahim', 'kandidatBpa'));
    }
}
