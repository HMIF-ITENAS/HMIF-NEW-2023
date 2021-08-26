<?php

namespace App\Http\Controllers\Main;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage()
    {
        $title = 'Homepage';
        $user_count = User::where('status', '=', 'active')->where('level', 'user')->count();
        $posts = Post::with(['user', 'category', 'tags'])->where('status', '=', 1)->latest()->limit(3)->get();
        $categories = Category::with(['posts'])->where('status', '=', 1)->get();
        $tags = Tag::where('status', '=', 1)->get();
        return view('app.homepage', compact('title', 'posts', 'categories', 'tags', 'user_count'));
    }
}
