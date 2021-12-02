<?php

namespace App\Http\Controllers\Admin;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'List Peminjaman';
        return view('admin.borrow.index', compact('title'));
    }

    public function getBorrows(Request $request)
    {
         if ($request->ajax()) {
	        $data = Borrow::with(['user', 'items'])->latest()->get();
	        return DataTables::of($data)
	            ->addIndexColumn()
	            ->addColumn('item_count', function ($row) {
	                return $row->items->count();
	            })
	            ->addColumn('user', function ($row) {
	                return "";
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
        $items = Item::where('stock', '>', 1)->get();
        $users = User::where('status', '=', 'active')->get();
        $title = "Buat Peminjaman Barang";
        return view('admin.borrow.create', compact('items', 'users', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
