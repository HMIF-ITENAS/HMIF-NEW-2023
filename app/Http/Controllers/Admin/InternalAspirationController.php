<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\InternalAspiration;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InternalAspirationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:aspirasi-internal-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:aspirasi-internal-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:aspirasi-internal-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:aspirasi-internal-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Aspirasi Internal';
        return view('admin.internal_aspiration.index', compact('title'));
    }

    public function getAspirations(Request $request)
    {
        if ($request->ajax()) {
            $data = InternalAspiration::with(['user'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    $name = 'Private';
                    if ($row->privacy === 'public') {
                        $name = $row->user->name;
                    }
                    return $name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.aspiration.internal.edit', $row->id);
                    $show_url = route('admin.aspiration.internal.show', $row->id);
                    $actionBtn = '<a class="btn btn-success internal_aspiration_detail" href="' . $show_url . '">
                    <i class="far fa-info-circle"></i>
                </a>
                <a class="btn btn-info internal_aspiration_edit" href="' . $edit_url . '">
                <i class="far fa-edit"></i>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-title="' . $row->title . '" href="#">
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
        $title = 'Buat Aspirasi Internal';
        return view('admin.internal_aspiration.create', compact('title'));
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
            'privacy' => 'required|string',
        ]);

        InternalAspiration::create([
            'title' => $request->title,
            'content' => $request->content,
            'privacy' => $request->privacy,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.aspiration.internal')->with('success', 'Aspirasi Internal berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InternalAspiration $aspiration)
    {
        $title = 'Detail Aspirasi Internal';
        return view('admin.internal_aspiration.show', compact('title', 'aspiration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InternalAspiration $aspiration)
    {
        $title = 'Edit Aspirasi';
        return view('admin.internal_aspiration.edit', compact('title', 'aspiration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $internalAspiration = InternalAspiration::find($id);
        if (auth()->user()->id != $internalAspiration->user_id) {
            return redirect()->route('admin.aspiration.internal')->with('danger', 'Aspirasi Internal tidak dapat dirubah tanpa seizin pemilik!');
        }
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:5',
            'privacy' => 'required|string',
        ]);

        $internalAspiration->update([
            'title' => $request->title,
            'content' => $request->content,
            'privacy' => $request->privacy,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('admin.aspiration.internal')->with('success', 'Aspirasi Internal berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InternalAspiration::find($id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
