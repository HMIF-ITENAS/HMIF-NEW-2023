<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Post';
        return view('admin.post.index', compact('title'));
    }

    public function getPosts(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::with(['tags', 'user', 'category'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('tags', function ($row) {
                    $tag_list = '';
                    foreach ($row->tags as $tags) {
                        $tag_list .= "<span class='badge badge-success mx-1'>#$tags->slug</span>";
                    }
                    return $tag_list;
                })
                ->addColumn('category_name', function ($row) {
                    return $row->category->name;
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 0) ? "Tidak Aktif" : "Aktif";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.post.edit', $row->id);
                    $show_url = route('admin.post.show', $row->id);
                    $actionBtn = '<a class="btn btn-success" href="' . $show_url . '">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass">
                        </use>
                    </svg>
                </a>
                <a class="btn btn-info" href="' . $edit_url . '">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil">
                        </use>
                    </svg>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-title="' . $row->title . '" href="#">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash">
                        </use>
                    </svg>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'tags'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Bikin Post';
        $categories = Category::orderBy('name', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();
        return view('admin.post.create', compact('categories', 'tags', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'category_id' => 'required|numeric',
            'tags' => 'required|array',
            'banner' => 'required|file|mimes:jpeg,jpg,png',
            'status' => 'required|integer',
        ]);

        $slug = Str::of($request->title)->slug('-');
        if ($slug->contains($slug)) {
            $post_slug = Post::where('slug', $slug)->get();
            if ($post_slug->count() > 0) {
                $slug = ($slug . '-' . Str::of($post_slug->count())->slug('-'));
            } else {
                $slug;
            }
        }

        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $banner_name = time() . '_' . $banner->getClientOriginalName();
            $banner->move(public_path('assets/banner'), $banner_name);
            $post = Post::create([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'banner' => $banner_name,
                'status' => $request->status,
                'user_id' => auth()->id()
            ]);
            $tags = $request->tags;
            $post->tags()->attach($tags);
            return redirect()->route('admin.post')->with('success', 'Post berhasil dibuat!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = 'Edit Post';
        $categories = Category::orderBy('name', 'ASC')->get();
        $tags = Tag::orderBy('name', 'ASC')->get();
        $tag_selected = $post->tags()->get();
        return view('admin.post.edit', compact('post', 'categories', 'tags', 'tag_selected', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'category_id' => 'required|numeric',
            'tags' => 'required|array',
            'banner' => 'file|mimes:jpeg,jpg,png',
            'status' => 'required|integer',
        ]);


        $slug = Str::of($request->title)->slug('-');
        if ($slug->contains($slug)) {
            $post_slug = Post::where('slug', $slug)->get();
            if ($post_slug->count() > 0) {
                $slug = ($slug . '-' . Str::of($post_slug->count())->slug('-'));
            } else {
                $slug;
            }
        }

        $banner_name = $post->banner;
        if ($request->hasFile('banner')) {
            if (file_exists('./assets/banner/' . $banner_name)) {
                unlink(public_path('assets/banner/' . $banner_name));
            }
            $banner = $request->file('banner');
            $banner_name = time() . '_' . $banner->getClientOriginalName();
            $banner->move(public_path('assets/banner'), $banner_name);
        }

        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'banner' => $banner_name,
            'status' => $request->status,
            'user_id' => auth()->id()
        ]);
        $tags = $request->tags;
        $post->tags()->sync($tags);
        return redirect()->route('admin.post')->with('success', 'Post berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        echo json_encode(array("status" => TRUE));
    }
}
