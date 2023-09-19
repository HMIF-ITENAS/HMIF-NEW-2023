<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
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
            $data = User::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('jabatan', function ($row) {
                    switch ($row->jabatan) {
                        case 0:
                            return "Anggota Tidak Aktif";
                            break;
                        case 1:
                            return "Anggota Aktif";
                            break;
                        case 2:
                            return "Badan Pengurus";
                            break;
                        case 3:
                            return "Badan Perwakilan Anggota";
                            break;

                        default:
                            return $row->jabatan;
                            break;
                    }
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.users.edit', $row->id);
                    $show_url = route('admin.users.show', $row->id);
                    $actionBtn = '<a class="btn btn-success user_detail" href="' . $show_url . '">
                    <i class="far fa-info-circle"></i>
                </a>
                <a class="btn btn-info user_edit" href="' . $edit_url . '">
                <i class="far fa-edit"></i>
                </a>
                <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" data-nrp="' . $row->nrp . '" href="#">
                <i class="far fa-trash"></i>
                </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'tags'])
                ->make(true);
        }
    }

    public function candidate(Request $request)
    {
        $search = $request->search;
        $leaderCandidates = LeaderCandidate::with(['user'])->get();
        $leaders = [];
        foreach ($leaderCandidates as $key => $value) {
            array_push($leaders, $value->user->id);
        }
        if ($search == '') {
            $data = User::anggotaAktif()->whereNotIn('id', $leaders)->get();
        } else {
            $data = User::anggotaAktif()->whereNotIn('id', $leaders)->where('nrp', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $d) {
            $response[] = array(
                "id" => $d->id,
                "text" => $d->nrp . ' - ' . $d->name,
            );
        }
        return response()->json($response);
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
    public function edit(User $user)
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
    public function show(User $user)
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
            'jabatan' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'nrp' => $request->nrp,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'status' => $request->status,
            'level' => $request->level,
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->route('admin.users')->with('success', 'User baru berhasil dibuat!');
    }

    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255',
            'nrp' => 'required|size:9|unique:users,nrp,' . $user,
            'angkatan' => 'required|size:4',
            // 'email' => 'sometimes|unique:users,email,' . $user,
            'status' => 'required|string',
            'level' => 'required|string',
            'jabatan' => 'required',
        ]);
        if (!$request->email) {
            User::whereId($user)->update([
                'name' => $request->name,
                'nrp' => $request->nrp,
                'angkatan' => $request->angkatan,
                'status' => $request->status,
                'jabatan' => $request->jabatan,
                'level' => $request->level,
            ]);
        } else {
            User::whereId($user)->update([
                'name' => $request->name,
                'nrp' => $request->nrp,
                'angkatan' => $request->angkatan,
                'email' => $request->email,
                'status' => $request->status,
                'jabatan' => $request->jabatan,
                'level' => $request->level,
            ]);
        }

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
        User::find($id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
