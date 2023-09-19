<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tag-list|tag-create|tag-edit|tag-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:tag-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tag-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Tag';
        $result = Tag::with(['posts'])->get();
        return view('admin.tag.index', compact('title'));
    }

    public function getTags(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::with(['posts'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('post_count', function ($row) {
                    return $row->posts->count();
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 0) ? "Tidak Aktif" : "Aktif";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.tag.edit', $row->id);
                    $show_url = route('admin.tag.show', $row->id);
                    $actionBtn = '<a class="btn btn-success tag_detail" href="' . $show_url . '">
                    <i class="far fa-info-circle"></i>
                </a>
                <a class="btn btn-info tag_edit" href="' . $edit_url . '">
                <i class="far fa-edit"></i>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
                <i class="far fa-trash"></i>
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
        $title = 'Bikin Tag';
        return view('admin.tag.create', compact('title'));
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
            'name' => 'required|min:5',
            'status' => 'required|integer',
        ]);

        $slug = Str::of($request->name)->slug('-');
        if ($slug->contains($slug)) {
            $tag_slug = Tag::where('slug', $slug)->get();
            if ($tag_slug->count() > 0) {
                $slug = ($slug . '-' . Str::of($tag_slug->count())->slug('-'));
            } else {
                $slug;
            }
        }

        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tag')->with('success', 'Tag berhasil dibuat!');
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
    public function edit(Tag $tag)
    {
        $title = 'Edit Tag';
        return view('admin.tag.edit', compact('tag', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'status' => 'required|integer',
        ]);

        $slug = Str::of($request->name)->slug('-');

        $tag->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tag')->with('success', 'Tag berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(['status' => TRUE]);
    }
}
