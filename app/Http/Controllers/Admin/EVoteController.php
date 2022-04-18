<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use DB;
use Illuminate\Http\Request;

class EVoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:evote-dashboard', ['only' => ['index', 'getCakahim', 'getCabpa']]);
    }

    public function index()
    {
        $title = 'E-Vote';
        return view('admin.evote.index', compact('title'));
    }

    public function getCakahim(Request $request)
    {
        $data = LeaderCandidate::with(['user'])->withCount('voters')->where('status', '=', 1)->get();
        return $data;
    }

    public function getCabpa(Request $request)
    {
        $data = LeaderCandidate::with(['user'])->withCount('voters')->where('status', '=', 2)->get();
        return $data;
    }
}
