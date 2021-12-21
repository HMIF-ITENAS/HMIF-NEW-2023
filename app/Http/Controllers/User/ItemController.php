<?php

namespace App\Http\Controllers\User;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\Item;
use Carbon\Carbon;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
	public function list(Request $request)
	{
		if ($request->ajax() && session()->has('peminjaman_alat_' . auth()->user()->nrp)) {
			$peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
			$data = Item::with(['unit'])->where('stock', '>', 0)->latest()->get();
			return DataTables::of($data)
				->addIndexColumn()
				->editColumn('stock', function ($row) use ($peminjaman_alat) {
					$item = Item::with(['borrows' => function ($query) use ($peminjaman_alat) {
						$query->whereDate('end_date', '>=', $peminjaman_alat['begin_date'])->whereDate('begin_date', '<=', $peminjaman_alat['end_date']);
					}])->where('id', $row->id)->first();
					if ($item->borrows->count() == 0) {
						return $row->stock;
					} else {
						$stock = $row->stock;
						foreach ($item->borrows as $borrows) {
							if ($borrows->pivot->item_id == $item->id) {
								$stock -= $borrows->pivot->qty;
							}
						}
						return $stock;
					}
				})
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
					$actionBtn = '<a class="btn btn-primary add_cart" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
	                    <i class="fas fa-plus"></i> Add to cart
	                </a>';
					return $actionBtn;
				})
				->rawColumns(['action'])
				->make(true);
		}
	}

	public function confirm(Request $request)
	{
		if ($request->ajax() && session()->has('peminjaman_alat_' . auth()->user()->nrp)) {
			$data = Cart::session(auth()->user()->id)->getContent();
			return DataTables::of($data)
				->addIndexColumn()
				->rawColumns(['action'])
				->make(true);
		}
	}

	public function cartList(Request $request)
	{
		if ($request->ajax()) {
			$csrf_field = csrf_field();
			$url_update = route('user.item.updateCart');
			$url_delete = route('user.item.deleteCart');
			$data = Cart::session(auth()->user()->id)->getContent();
			return DataTables::of($data)
				->addIndexColumn()
				->editColumn('quantity', function ($row) use ($csrf_field, $url_update) {
					$actionBtn = "
					<form action='$url_update' method='POST'>
						$csrf_field
						<input name='_method' value='PUT' type='hidden'>
						<input name='id' value='$row->id' type='hidden'>
						<input name='quantity' value='$row->quantity' type='number' class='form-control'>
						<div class='d-flex justify-content-center mt-3'>
							<button class='btn btn btn-info text-center' type='submit'>Update</button>
						</div>
					</form>
					";
					return $actionBtn;
				})
				->addColumn('action', function ($row) use ($csrf_field, $url_delete) {
					$actionBtn = "
						<form action='$url_delete' method='POST'>
							$csrf_field
							<input name='_method' value='DELETE' type='hidden'>
							<input name='id' value='$row->id' type='hidden'>
							<button type='submit' class='btn btn-sm btn-danger'>
								<i class='fa fa-trash'></i>
							</button>
						</form>
						";
					return $actionBtn;
				})
				->rawColumns(['action', 'quantity'])
				->make(true);
		}
	}

	public function addToCart(Request $request, $id)
	{
		$request->validate([
			'qty' => 'required|numeric'
		]);
		$peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
		$item_original = Item::find($id);
		$item = Item::with(['borrows' => function ($query) use ($peminjaman_alat) {
			$query->whereDate('end_date', '>=', $peminjaman_alat['begin_date'])->whereDate('begin_date', '<=', $peminjaman_alat['end_date']);
		}])->where('id', $id)->first();
		if ($item->borrows->count() == 0) {
			$stock = $item_original->stock;
		} else {
			$stock = $item_original->stock;
			foreach ($item->borrows as $borrows) {
				if ($borrows->pivot->item_id == $item->id) {
					$stock -= $borrows->pivot->qty;
				}
			}
		}
		if ($stock < 1) {
			return response()->json(['status' => FALSE, 'message' => 'Stok habis!']);
		}
		if ($request->qty > $stock) {
			return response()->json(['status' => false, 'message' => 'Quantity tidak boleh lebih dari stock!']);
		}
		$userId = auth()->user()->id;
		Cart::session($userId)->add([
			'id' => $id,
			'name' => $item->name,
			'quantity' => $request->qty,
			'price' => $item->unit_price,
		]);
		return response()->json(['status' => TRUE, 'message' => 'Berhasil Memasukkan Data Ke Keranjang']);
	}
	public function updateCart(Request $request)
	{
		$request->validate([
			'id' => 'required|numeric',
			'quantity' => 'required|numeric'
		]);
		$peminjaman_alat = session()->get('peminjaman_alat_' . auth()->user()->nrp);
		$item_original = Item::find($request->id);
		$item = Item::with(['borrows' => function ($query) use ($peminjaman_alat) {
			$query->whereDate('end_date', '>=', $peminjaman_alat['begin_date'])->whereDate('begin_date', '<=', $peminjaman_alat['end_date']);
		}])->where('id', $request->id)->first();
		if ($item->borrows->count() == 0) {
			$stock = $item_original->stock;
		} else {
			$stock = $item_original->stock;
			foreach ($item->borrows as $borrows) {
				if ($borrows->pivot->item_id == $item->id) {
					$stock -= $borrows->pivot->qty;
				}
			}
		}
		if ($stock < 1) {
			return response()->json(['status' => FALSE, 'message' => 'Stok habis!']);
		}
		if ($request->qty > $stock) {
			return response()->json(['status' => false, 'message' => 'Quantity tidak boleh lebih dari stock!']);
		}

		\Cart::session(auth()->user()->id)->update($request->id, [
			'quantity' => [
				'relative' => false,
				'value' => $request->quantity
			],
		]);

		return redirect()->route('user.borrow.alat')->with('success', 'Berhasil mengupdate cart!');
	}

	public function deleteCart(Request $request)
	{
		$request->validate([
			'id' => 'required|numeric',
		]);

		\Cart::session(auth()->user()->id)->remove($request->id);

		return redirect()->route('user.borrow.alat')->with('success', 'Berhasil menghapus item pada cart!');
	}
	public function getCartCount()
	{
		$cart = Cart::session(auth()->user()->id)->getContent();
		return response()->json(['data' => $cart, 'count' => $cart->count()]);
	}
}
