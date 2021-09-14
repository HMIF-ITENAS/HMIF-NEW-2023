<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\ExternalAspiration;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExternalAspirationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:aspirasi-external-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:aspirasi-external-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:aspirasi-external-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:aspirasi-external-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Aspirasi Eksternal';
        return view('admin.external_aspiration.index', compact('title'));
    }

    public function getAspirations(Request $request)
    {
        if ($request->ajax()) {
            $data = ExternalAspiration::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.aspiration.external.edit', $row->id);
                    $show_url = route('admin.aspiration.external.show', $row->id);
                    $actionBtn = '<a class="btn btn-success" href="' . $show_url . '">
                    <svg class="c-icon">
                        <use xlink:href=' . asset("admin/vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass")  . '>
                        </use>
                    </svg>
                </a>
                <a class="btn btn-info" href="' . $edit_url . '">
                    <svg class="c-icon">
                        <use xlink:href=' . asset("admin/vendors/@coreui/icons/svg/free.svg#cil-pencil") . '>
                        </use>
                    </svg>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-title="' . $row->title . '" href="#">
                    <svg class="c-icon">
                        <use xlink:href=' . asset("admin/vendors/@coreui/icons/svg/free.svg#cil-trash") . '>
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
        $title = 'Buat Aspirasi Eksternal';
        return view('admin.external_aspiration.create', compact('title'));
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

        return redirect()->route('admin.aspiration.external')->with('success', 'Aspirasi Eksternal berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExternalAspiration $aspiration)
    {
        $title = 'Detail Aspirasi Eksternal';
        return view('admin.external_aspiration.show', compact('title', 'aspiration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExternalAspiration $aspiration)
    {
        $title = 'Edit Aspirasi';
        return view('admin.external_aspiration.edit', compact('title', 'aspiration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExternalAspiration $aspiration)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'from' => 'required|min:5',
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'status' => 'required|string',
        ]);

        $aspiration->update([
            'name' => $request->name,
            'from' => $request->from,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.aspiration.external')->with('success', 'Aspirasi Eksternal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExternalAspiration::find($id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
