<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $title = "Album Kegiatan";
        $albums = Album::with('photos')->where('status', '=', 1)->latest()->get();
        return view('app.album.index', compact('title', 'albums'));
    }

    public function show($slug)
    {
        $title = "Detail Album Kegiatan";
        $album = Album::with('photos')->where('status', '=', '1')->where('slug', '=', $slug)->firstOrFail();
        return view('app.album.show', compact('title', 'album'));
    }
}
