<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\InternalAspiration;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function create()
    {
        $title = "Buat Aspirasi";
        return view('user.aspirasi', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'privacy' => 'required|string',
        ]);

        InternalAspiration::create([
            'title' => $request->title,
            'content' => $request->content,
            'privacy' => $request->privacy,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Aspirasi Internal berhasil dibuat!');
    }
}
