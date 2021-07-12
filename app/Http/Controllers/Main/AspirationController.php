<?php

namespace App\Http\Controllers\Main;

use App\ExternalAspiration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index()
    {
        $title = "Aspirasi";
        return view('app.aspiration.index', compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'from' => 'required|min:5',
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'status' => 'required|string',
        ]);

        ExternalAspiration::create([
            'name' => $request->name,
            'from' => $request->from,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Aspirasi Eksternal berhasil dibuat!');
    }
}
