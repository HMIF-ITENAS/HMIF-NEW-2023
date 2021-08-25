<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function sejarah()
    {
        $title = "Sejarah & Visi Misi";
        return view('app.about.sejarah', compact('title'));
    }

    public function kahim()
    {
        $title = "Ketua Himpunan (HMIF)";
        return view('app.about.kahim', compact('title'));
    }

    public function struktur()
    {
        $title = "Struktur Organisasi";
        return view('app.about.struktur', compact('title'));
    }
}
