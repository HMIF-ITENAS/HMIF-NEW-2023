<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use App\Unit;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:unit-list|unit-create|unit-edit|unit-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:unit-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:unit-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:unit-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Unit';
        $result = Unit::with(['items'])->get();
        return view('admin.unit.index', compact('title'));
    }

    public function getUnits(Request $request)
    {
        if ($request->ajax()) {
            $data = Unit::with(['items'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('item_count', function ($row) {
                    return $row->items->count();
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 0) ? "Tidak Aktif" : "Aktif";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.unit.edit', $row->id);
                    $show_url = route('admin.unit.show', $row->id);
                    $actionBtn = '<a class="btn btn-success unit_detail" href="' . $show_url . '">
                    <i class="far fa-info-circle"></i>
                </a>
                <a class="btn btn-info unit_edit" href="' . $edit_url . '">
                <i class="far fa-edit"></i>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
                <i class="far fa-trash"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'units'])
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
        $title = 'Bikin Unit';
        return view('admin.unit.create', compact('title'));
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
            'name' => 'required',
        ]);

        Unit::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.unit')->with('success', 'Unit berhasil dibuat!');
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
    public function edit(Unit $unit)
    {
        $title = 'Edit Unit';
        return view('admin.unit.edit', compact('unit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $unit->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.unit')->with('success', 'Unit berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return response()->json(['status' => TRUE]);
    }
}
