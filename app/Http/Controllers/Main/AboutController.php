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
}
