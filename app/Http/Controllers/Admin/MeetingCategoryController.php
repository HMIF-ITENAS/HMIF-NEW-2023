<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MeetingCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MeetingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Kategori Rapat";
        return view('admin.meeting_category.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Buat Kategori Rapat";
        return view('admin.meeting_category.create', compact('title'));
    }

    public function getMeetingCategory(Request $request)
    {
        if ($request->ajax()) {
            $data = MeetingCategory::with(['meetings'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('meeting_count', function ($row) {
                    return $row->meetings->count();
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 0) ? "Tidak Aktif" : "Aktif";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.meeting_category.edit', $row->id);
                    $actionBtn = '
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

        MeetingCategory::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.meeting_category')->with('success', 'Kategori Rapat berhasil dibuat!');
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
    public function edit($id)
    {
        $title = "Edit Kategori Rapat";
        $meetingCategory = MeetingCategory::findOrFail($id);
        return view('admin.meeting_category.edit', compact('title', 'meetingCategory'));
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
        $this->validate($request, [
            'name' => 'required|min:5',
            'status' => 'required|integer',
        ]);
        $meetingCategory = MeetingCategory::findOrFail($id);
        $meetingCategory->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.meeting_category')->with('success', 'Kategori Rapat berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meetingCategory = MeetingCategory::findOrFail($id);
        $meetingCategory->delete();
        return response()->json(['status' => TRUE]);
    }
}
