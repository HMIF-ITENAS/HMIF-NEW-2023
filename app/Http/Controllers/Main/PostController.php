<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $title = 'Postingan';
        $posts = Post::with(['user', 'category', 'tags'])->where('status', '=', 1)->latest()->paginate(6);
        $categories = Category::with(['posts'])->get();
        $tags = Tag::all();
        return view('app.post.index', compact('title', 'posts', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $title = 'Detail Postingan';
        $post = Post::with(['user', 'category', 'tags'])->where('status', '=', 1)->where('slug', '=', $slug)->firstOrFail();
        $categories = Category::with(['posts'])->get();
        $tags = Tag::all();
        return view('app.post.show', compact('title', 'post', 'categories', 'tags'));
    }

    public function category($slug)
    {
        $title = 'Per Kategori';
        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $posts = $category->getPaginatedPosts(10);
        $categories = Category::with(['posts'])->get();
        $tags = Tag::all();
        return view('app.post.post_by_category', compact('title', 'posts', 'categories', 'tags', 'category'));
    }

    public function tag($slug)
    {
        $title = 'Per Kategori';
        $tag_posts = Tag::where('slug', '=', $slug)->firstOrFail();
        $post_by_tag = Post::with(['user', 'category', 'tags'])->where('status', '=', 1)->whereHas('tags', function ($q) use ($slug) {
            $q->where('slug', '=', $slug);
        })->paginate(10);
        $categories = Category::with(['posts'])->get();
        $tags = Tag::all();
        return view('app.post.post_by_tag', compact('title', 'categories', 'tags', 'tag_posts', 'post_by_tag'));
    }
}
