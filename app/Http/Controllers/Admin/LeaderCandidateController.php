<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LeaderCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(LeaderCandidate::with(['user', 'voters'])->get());
        $title = 'List Kandidat';
        return view('admin.leader-candidate.index', compact('title'));
    }

    public function getLeaderCandidates(Request $request)
    {
        if ($request->ajax()) {
            $data = LeaderCandidate::with(['user', 'voters'])->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('voters', function ($row) {
                    return $row->voters->count();
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Ketua Himpunan' : 'BPA';
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.leader-candidate.edit', $row->id);
                    $show_url = route('admin.leader-candidate.show', $row->id);
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
                    <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->user->name . '" href="#">
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
        $title = 'Tambah Kandidat';
        return view('admin.leader-candidate.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nomor_urut' => 'required',
            'foto' => 'required|file|mimes:jpeg,jpg,png',
            'status' => 'required|integer',
        ]);

        // dd($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto_name = time() . '_' . $foto->getClientOriginalName();
            $foto_name = preg_replace('!\s+!', ' ', $foto_name);
            $foto_name = str_replace(' ', '_', $foto_name);
            $foto_name = str_replace('%', '', $foto_name);
            $status = $request->status == 1 ? 'kahim' : 'bpa';
            $foto->move(public_path("assets/kandidat/$status"), $foto_name);
            LeaderCandidate::create([
                'user_id' => $request->user_id,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'foto' => $foto_name,
                'status' => $request->status,
                'nomor_urut' => $request->nomor_urut
            ]);
            return redirect()->route('admin.leader-candidate.index')->with('success', 'Kandidat berhasil ditambahkan!');
        } else {
            return redirect()->route('admin.leader-candidate.create')->with('danger', 'Mohon upload foto!');
        }
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
    public function edit(LeaderCandidate $leaderCandidate)
    {
        $title = 'Edit Kandidat';
        return view('admin.leader-candidate.edit', compact('title', 'leaderCandidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaderCandidate $leaderCandidate)
    {
        $request->validate([
            'user_id' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nomor_urut' => 'required',
            'foto' => 'file|mimes:jpeg,jpg,png',
            'status' => 'required|integer',
        ]);

        // dd($request->all());

        if ($request->hasFile('foto')) {
            $foto_exist = $leaderCandidate->foto;
            $status = $leaderCandidate->status == 1 ? 'kahim' : 'bpa';
            $foto = $request->file('foto');
            if (file_exists("./assets/kandidat/$status/" . $foto_exist)) {
                unlink(public_path("assets/kandidat/$status/" . $foto_exist));
            }
            $foto_name = time() . '_' . $foto->getClientOriginalName();
            $foto_name = preg_replace('!\s+!', ' ', $foto_name);
            $foto_name = str_replace(' ', '_', $foto_name);
            $foto_name = str_replace('%', '', $foto_name);
            $status = $request->status == 1 ? 'kahim' : 'bpa';
            $foto->move(public_path("assets/kandidat/$status"), $foto_name);
            $leaderCandidate->update([
                'user_id' => $request->user_id,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'foto' => $foto_name,
                'status' => $request->status,
                'nomor_urut' => $request->nomor_urut
            ]);
            return redirect()->route('admin.leader-candidate.index')->with('success', 'Kandidat berhasil diubah!');
        } else {
            $leaderCandidate->update([
                'user_id' => $request->user_id,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'nomor_urut' => $request->nomor_urut,
                'status' => $request->status
            ]);
            return redirect()->route('admin.leader-candidate.index')->with('success', 'Kandidat berhasil diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaderCandidate $leaderCandidate)
    {
        $status = $leaderCandidate->status == 1 ? 'kahim' : 'bpa';
        $path_foto = public_path("assets\kandidat\\$status\\$leaderCandidate->foto");

        if (File::exists($path_foto)) {
            unlink($path_foto);
        }
        $leaderCandidate->delete();
        return response()->json(['status' => TRUE]);
    }
}
