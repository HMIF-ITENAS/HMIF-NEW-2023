<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Users;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User';
        return view('admin.users.index', compact('title'));
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = Users::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.users.edit', $row->id);
                    $show_url = route('admin.users.show', $row->id);
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
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" data-nrp="' . $row->nrp . '" href="#">
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
        $title = 'Buat User';
        return view('admin.users.create', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $user)
    {
        $title = 'Edit User';
        return view('admin.users.edit', compact('title', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Users $user)
    {
        $title = 'Detail User';
        return view('admin.users.show', compact('title', 'user'));
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
            'name' => 'required|min:5|max:255',
            'nrp' => 'required|size:9|unique:users,nrp',
            'angkatan' => 'required|size:4',
            'email' => 'required|min:5|unique:users,email',
            'status' => 'required|string',
            'level' => 'required|string',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Users::create([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'status' => $request->status,
            'level' => $request->level,
            'password' => Hash::make($request['password']),
            // 'password' => $request->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'User baru berhasil dibuat!');
    }

    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'nrp' => 'required|size:9|unique:users,nrp,'. $user,
            'angkatan' => 'required|size:4',
            'email' => 'required|min:5|unique:users,email,'. $user,
            'status' => 'required|string',
            'level' => 'required|string',
        ]);

        Users::whereId($user)->update([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'status' => $request->status,
            'level' => $request->level,
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Users::find($id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
