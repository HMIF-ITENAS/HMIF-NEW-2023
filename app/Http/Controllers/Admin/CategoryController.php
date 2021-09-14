<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kategori-list|kategori-create|kategori-edit|kategori-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:kategori-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kategori-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kategori-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Kategori';
        $result = Category::with(['posts'])->get();
        return view('admin.category.index', compact('title'));
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::with(['posts'])->latest()->get();
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
                    $edit_url = route('admin.category.edit', $row->id);
                    $show_url = route('admin.category.show', $row->id);
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
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash">
                        </use>
                    </svg>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
        $title = 'Bikin Kategori';
        return view('admin.category.create', compact('title'));
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
            $tag_slug = Category::where('slug', $slug)->get();
            if ($tag_slug->count() > 0) {
                $slug = ($slug . '-' . Str::of($tag_slug->count())->slug('-'));
            } else {
                $slug;
            }
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategori berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $title = 'Edit Kategori';
        return view('admin.category.edit', compact('category', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'status' => 'required|integer',
        ]);

        $slug = Str::of($request->name)->slug('-');

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.category')->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['status' => TRUE]);
    }
}
