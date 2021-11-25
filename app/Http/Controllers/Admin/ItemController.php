<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Item;
use App\Unit;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Unit';
        return view('admin.item.index', compact('title'));
    }

    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            $data = Item::with(['unit'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('unit', function ($row) {
                    return $row->unit->name;
                })
                ->editColumn('status', function ($row) {
                    return ($row->status == 0) ? "Tidak Aktif" : "Aktif";
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.item.edit', $row->id);
                    $show_url = route('admin.item.show', $row->id);
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
        $title = 'Bikin Item';
        $units = Unit::all();
        return view('admin.item.create', compact('title', 'units'));
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
            'stock' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'description' => 'required|min:5',
            'status' => 'required'
        ]);

        Item::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'unit_id' => $request->unit_id,
            'unit_price' => $request->unit_price,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.item')->with('success', 'Item berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $title = 'Edit Item';
        $units = Unit::all();
        return view('admin.item.edit', compact('title', 'item', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $this->validate($request, [
            'name' => 'required',
            'stock' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'description' => 'required|min:5',
            'status' => 'required'
        ]);

        $item->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'unit_id' => $request->unit_id,
            'unit_price' => $request->unit_price,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.item')->with('success', 'Item berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['status' => TRUE]);
    }
}
