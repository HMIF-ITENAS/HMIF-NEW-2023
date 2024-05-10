<?php

namespace App\Http\Controllers\Admin;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\Item;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:peminjaman-list|peminjaman-show|peminjaman-status|peminjaman-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:peminjaman-status', ['only' => ['status']]);
        $this->middleware('permission:peminjaman-delete', ['only' => ['destroy']]);
    }
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
                    return $row->user->name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $show_url = route('admin.borrow.show', $row->id);
                    $actionBtn = '
                    <a class="btn btn-success borrow_detail" href="' . $show_url . '">
                    <i class="far fa-info-circle"></i>
                    </a>
                    <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->invoice . '" href="#">
                    <i class="far fa-trash"></i>
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
        $items = Item::where('status', 1)->where('stock', '>', 1)->get();
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
        $title = "Detail Peminjaman";
        $borrow = Borrow::with(['items'])->findOrFail($id);
        return view('admin.borrow.show', compact('title', 'borrow'));
    }

    public function listDetail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Borrow::with(['user', 'items'])->whereHas('user')->findOrFail($id);
            return DataTables::of($data->items)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('qty', function ($row) {
                    return $row->pivot->qty;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|numeric'
        ]);
        $borrow = Borrow::findOrFail($id);
        $borrow->update([
            'status' => ($request->status == "1" ? "Disetujui" : "Tidak Disetujui")
        ]);

        return redirect()->back()->with('success', 'Status berhasil diubah!');
    }

    public function returned(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|numeric'
        ]);
        $borrow = Borrow::findOrFail($id);
        $borrow->update([
            'status' => ($request->status == "1" ? "Sudah Dikembalikan" : "Tidak Disetujui"),
            'returned_at' => Carbon::now()->toDateTimeString()
        ]);

        return redirect()->back()->with('success', 'Barang sudah dikembalikan!');
    }

    public function tolak(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->update([
            'status' => "Tidak Disetujui",
            'pesan_tolak' => $request->pesan_tolak
        ]);

        return response()->json(['status' => TRUE, 'message' => 'Berhasil menolak peminjaman!']);
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
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();
        return response()->json(['status' => TRUE]);
    }
}
