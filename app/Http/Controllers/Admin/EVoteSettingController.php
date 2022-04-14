<?php

namespace App\Http\Controllers\Admin;

use App\EvoteSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EVoteSettingController extends Controller
{
    public function index()
    {
        $title = "E-Vote Settings";
        $data = EvoteSetting::first();
        return view('admin.e_vote_setting.index', compact('title', 'data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'begin_date' => 'required',
            'start_vote_at' => 'required',
            'end_vote_at' => 'required|after:start_vote_at',
        ]);

        $data = EvoteSetting::find(1);
        $data->update([
            'begin_date' => $request->begin_date,
            'start_vote_at' => $request->start_vote_at,
            'end_vote_at' => $request->end_vote_at,
        ]);
        return redirect()->back()->with('success', 'E-Vote Settings Updated Successfully');
    }
}
