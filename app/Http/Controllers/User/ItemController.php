<?php

namespace App\Http\Controllers\User;

use App\Borrow;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function list(Request $request){
	    if ($request->ajax()) {
		    $data = Item::with(['unit'])->where('stock', '>', 1)->latest()->get();
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
			                     $actionBtn = '<a class="btn btn-primary add_cart" data-id="'. $row->id. '" data-name="'. $row->name .'" href="#">
	                    <i class="fas fa-plus"></i> Add to cart
	                </a>';
			                     return $actionBtn;
		                     })
		                     ->rawColumns(['action'])
		                     ->make(true);
	    }
    }
    
    public function checkQty(Request $request){
    	$request->validate([
    		'id' => 'required|numeric',
		    'qty' => 'required|numeric'
	    ]);
    	
    	$item = Item::findOrFail($request->id);
    	
    	return ($request->qty > $item->stock) ?
		    response()->json(['status' => false, 'message' => 'Quantity tidak boleh lebih dari stock!']) :
		    response()->json(['status' => true, 'message' => 'Sukses menambahkan ke cart!']);
//    	if($request->qty > $item->qty){
//    		return response()->json(['status' => false]);
//	    }
    
    }
}
