<?php

namespace App\Http\Controllers\Main;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        $title = 'Homepage';
        $posts = Post::with(['user', 'category', 'tags'])->latest()->limit(3)->get();
        $categories = Category::with(['posts'])->get();
        $tags = Tag::all();
        return view('app.homepage', compact('title', 'posts', 'categories', 'tags'));
    }
}
