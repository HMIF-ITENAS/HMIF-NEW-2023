<?php

namespace App\Http\Controllers\User;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\Item;
use Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Darryldecode\Cart\Facades\CartFacade as Cart;

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
        return view('user.borrow.index', compact('title'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = Borrow::with(['user', 'items'])->whereHas('user', function (Builder $query) {
                $query->where('id', '=', auth()->user()->id);
            })->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('item_count', function ($row) {
                    return $row->items->count();
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('user.borrow.edit', $row->id);
                    $show_url = route('user.borrow.show', $row->id);
                    if ($row->status == "Sedang Diajukan") {
                        $actionBtn = '<a class="btn btn-success" href="' . $show_url . '">
	                    <i class="fas fa-eye"></i>
	                </a>
	                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-invoice="' . $row->invoice . '" href="#">
	                    <i class="fas fa-trash"></i>
	                </a>';
                    } else {
                        $actionBtn = '
                        <a class="btn btn-success" href="' . $show_url . '">
                            <i class="fas fa-eye"></i>
                        </a>
                        ';
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function listDetail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Borrow::with(['user', 'items'])->whereHas('user', function (Builder $query) {
                $query->where('id', '=', auth()->user()->id);
            })->findOrFail($id);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = "Buat Peminjaman Barang";
        return view('user.borrow.create', compact('title'));
    }

    public function alat()
    {
        $items = Item::where('status', 1)->where('stock', '>', 1)->get();
        $title = "Pilih Barang";
        $cart = Cart::session(auth()->user()->id)->getContent();
        $peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
        return view('user.borrow.alat', compact('items', 'title', 'cart', 'peminjaman_alat'));
    }

    public function confirm()
    {
        if (session()->has('peminjaman_alat_' . auth()->user()->nrp)) {
            if (!Cart::session(auth()->user()->id)->isEmpty()) {
                $title = "Konfirmasi Peminjaman";
                $peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
                return view('user.borrow.confirm', compact('title', 'peminjaman_alat'));
            } else {
                return redirect()->route('user.borrow.alat')->with('danger', 'Keranjang masih kosong!');
            }
        } else {
            return redirect()->route('user.borrow')->with('danger', 'Anda tidak memiliki sesi!');
        }
    }

    public function confirmStore(Request $request)
    {
        if (session()->has('peminjaman_alat_' . auth()->user()->nrp)) {
            $request->validate([
                'confirm' => 'required|numeric'
            ]);
            if ($request->confirm == 1) {
                $peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
                $carts = Cart::session(auth()->user()->id)->getContent();
                $carts = $carts->toArray();
                $peminjaman = Borrow::create([
                    'begin_date' => $peminjaman_alat['begin_date'],
                    'end_date' => $peminjaman_alat['end_date'],
                    'description' => $peminjaman_alat['description'],
                    'status' => "Sedang Diajukan",
                    'user_id' => auth()->user()->id,
                ]);

                $peminjaman->update([
                    'invoice' =>  $this->generateNomorSurat($peminjaman)
                ]);
                foreach ($carts as $cart) {
                    $peminjaman->items()->attach([$cart['id'] => ['qty' => $cart['quantity']]]);
                }
                session()->forget(['peminjaman_alat_' . auth()->user()->nrp]);
                return redirect()->route('user.borrow')->with('success', 'Berhasil meminjam alat! Mohon menunggu persetujuan');
            } else {
                session()->forget(['peminjaman_alat_' . auth()->user()->nrp]);
                return redirect()->route('user.borrow')->with('danger', 'Anda tidak memiliki sesi!');
            }
        } else {
            session()->forget(['peminjaman_alat_' . auth()->user()->nrp]);
            return redirect()->route('user.borrow')->with('danger', 'Anda tidak memiliki sesi!');
        }
    }

    public function generateNomorSurat(Borrow $borrow)
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;
        return "$borrow->id/HMIF ITENAS/INVENTARIS/$bulan/$tahun";
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'begin_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:begin_date',
            'description' => 'required'
        ]);
        $peminjaman_alat = $request->all();
        $peminjaman_alat = Arr::except($peminjaman_alat, '_token');
        session()->put('peminjaman_alat_' . auth()->user()->nrp, $peminjaman_alat);
        return redirect()->route('user.borrow.alat')->with('success', 'Silakan pilih Alat yang akan dipinjam!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Borrow $borrow)
    {
        $title = "Detail Peminjaman";
        return view('user.borrow.show', compact('title', 'borrow'));
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
    public function destroy(Borrow $borrow)
    {
        $borrow->delete();
        return response()->json(['status' => TRUE]);
    }
}
